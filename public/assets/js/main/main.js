/**
 * send data to server
 *
 * @param {string} url
 * @param {object} dataToSend
 */
let sendPost = (route, dataToSend) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: url + route,
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            },
            data: dataToSend,
            success: function (response) {
                resolve(response);
            },
            error: function (err) {
                reject(err);
            }
        });
    });
};
/**
 * send formdata to server
 *
 * @param {string} url
 * @param {object} dataToSend
 */
let sendPostFormData = (route, dataToSend) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'json',
            url: route,
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            },
            data: dataToSend,
            success: function (response) {
                resolve(response);
            },
            error: function (err) {
                reject(err);
            }
        });
    });
};


/**
 * form submit
 *
 * @param {DOM} form
 */
let form_submit = (form, callback) => {

    let data = new FormData(form),
        submit_url = $(form).attr("action");

    $(form).parsley().validate();
    if ($(form).parsley().isValid()) {
        sendPostFormData(submit_url, data)
            .then((response) => {
                if (response.STATUS === "SUCCESS") {
                    $(form).parents(".modal").modal("hide");
                    $(form)[0].reset();
                    if (callback)
                        callback(response);
                    delete_validate_error(form);
                    delete_warning(form);
                    if ($(form).find(".nav-tabs > li:first-child > a").length) {
                        $(form).find(".nav-tabs > li:first-child > a")[0].click();
                    }
                }

                if (response.STATUS === "ERROR") {
                    show_validate_error(response, form);
                }
                if (response.STATUS === "WARNING") {
                    show_warning(response, form);
                }
                $(form).find('[type="submit"]').attr("disabled", false);
                showNotification(response.STATUS.toLowerCase(), response.MESSAGE);
            })
            .catch((err) => console.log(err));
    }
};

/**
 * show the validation error from backend
 * @param data
 * @param form
 */
let show_validate_error = (data, form) => {
    delete_validate_error(form);
    $.each(data['DATA'], function (key, value) {
        let field_parent = $(form).find(`[name="${key}"]`).parent();

        if ($(form).find('[name="' + key + '"]').hasClass('dropify'))
            field_parent = field_parent.parent();

        field_parent.append(
            `<span class="errorValidation text-danger"> ERROR : ${value}</span>`
        );
    });
};

/**
 * delete old  validation error from backend
 * @param form
 */
let delete_validate_error = (form) => {
    $(form).parsley().reset();
    $(form).find("span.errorValidation").remove();
};

/**
 * function reset forms
 *
 * @param form
 */

function reset_form(form) {
    $(form)[0].reset();
    delete_validate_error(form);
}

/**
 * send data to backend with ajax
 * this btn should contien
 * 1-data-action to difiend route
 * 1-data-(anything) to difiend dara
 * 1-data-function to run functions after getting this response ex (fn1,fn2) --- optionnel
 */
$(document).on("click", ".genericDatatBtn", function () {
    let genericDatatBtn = $(this),
        data = {},
        call_functions = false, route = '';
    $.each(genericDatatBtn.data(), function (key, value) {
        if (key == "function") call_functions = value;
        else if (key == "action") route = value;
        else data[key] = value;
    });
    sendPost(route, data)
        .then((response) => {
            if (response.STATUS === "SUCCESS") {
                if (call_functions) {
                    call_functions = call_functions.split(",");
                    call_functions.forEach((call_function) => window[call_function]());
                }
            }
            showNotification(response.STATUS.toLowerCase(), response.MESSAGE);
        })
        .catch((err) => console.log(err));

});

/**
 * update form delete with id found in (data-id) url in (data-action)
 */

$(document).on("click", ".genericDeleteModalBtn", function () {
    let deleteModal = $("#genericDeleteModal"),
        btnOpenDeleteModal = $(this),
        id = btnOpenDeleteModal.attr("data-id"),
        route = url + btnOpenDeleteModal.attr("data-action");
    deleteModal.find("form").attr("action", route);
    deleteModal.find('[name="id"]').val(id);

    delete_warning(deleteModal.find("form"));
    delete_validate_error(deleteModal.find("form"));

    deleteModal.modal("show");
});


/**
 * delete old  warning(ex permission) from backend
 * @param form
 */
let delete_warning = (form) => {
    $(form).find(".warning_remove").remove();
};


/**
 * show warning(ex permission) from backend
 * @param data
 * @param form
 */
let show_warning = (data, form) => {
    delete_warning(form);
    $(form).prepend(
        `<div class="alert alert-warning warning_remove " role="alert">${data.MESSAGE}</div>`
    );
};


/**
 * toast configuration
 */
const Toast = Swal.mixin({
    toast: true,
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

/**
 * active notification
 * @param string icon
 * @param string title
 */
let showNotification = (icon, title) => {
    Toast.fire({
        icon: icon,
        title: title,
        position: 'top-end'
    })
}

/**
 * get table list
 *
 * @param table
 * @param callback
 * @constructor
 */

let GetTableList = (table, callback) => {
    sendPost('/GlobalController/GetTableList', {table: table})
        .then((response) => {
            if (response.STATUS === "SUCCESS") {
                let data = response.DATA;
                if (callback)
                    callback(data)
            }
        })
        .catch((err) => console.log(err));
};

/**
 * codebar generator funtion
 *
 * barcode_type => global coming from settings
 *
 * @param  form
 * @param {string} value
 */
function generateBarcode(form, value) {

    let settings = {
        output: 'bmp',
        bgColor: 'rgba(0,0,0,0)',
        color: '#000000',
        barWidth: "1",
        barHeight: '50',
        moduleSize: '5',
        posX: 10,
        posY: 20
    };
    form.find(".barcode-image").empty().show().barcode(value, 'code128', settings);
    form.find(".barcode-image ,.barcode-image img").css('max-width', '100%')
}


function receipt_type(type) {

    if (type === 'string')
        return 'text';

    if (type === 'decimal')
        return 'number';

    if (type === 'integer')
        return 'number';

    if (type === 'alpha_spaces')
        return 'text';

    return type;

}

function receipt_validation(type) {

    if (type === 'string')
        return '';

    if (type === 'decimal')
        return 'data-parsley-type="number"';

    if (type === 'alpha_spaces')
        return `data-parsley-pattern="/^([a-ÿA-Zء-ي0-9, ']|\s)+$/"`;

    return type;

}


/**
 * toast configuration
 */
const confirmationToast = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
});


$(document).on('hidden.bs.modal', function () {

    if ($('.modal:visible').length)
        $('body').addClass('modal-open');

});


// function refresh  image
function refreshImages() {
    console.log(111)
    d = new Date();
    $('img').each(function () {
        let image = $(this),
            old_src = image.attr('src'),
            new_src = old_src + '?' + d.getTime();


        if(!image.parents('.dropify-preview').length){
            image.attr('src', '');
            image.attr('src', new_src)

        }

    });
}
