let dataTableReceipt;
let formTitle;
let dataTablePrefix;

$(document).ready(function () {

    if ($(location).attr('href') == url + '/receipts') {
        reload_datatable_receipt();

        //open modal view receipt
        dataTableReceipt.on('click', 'tr .viewReceipt', function () {
            let form = $('#formViewReceipt');

            let row = $(this).parents('tr'),
                data = dataTableReceipt.row(row).data(),
                field = '';


            reset_form(form);

            form.find('[name="id"]').val(data.id);

            form.find('#number_of_copy').val(1);

            form.find('.receiptAmount').hide();

            form.find('.receiptCopy').show();
            form.find('.printReceipt').show();
            form.find('.printReceipt').attr('href', url + '/PdfController/printReceipt/' + data.id + '/' + 1);

            getReceiptById(data.id, function (receiptList) {
                let code = receiptList.code,
                    amountExist = false;

                $.each(receiptList.receipt_field, function (i, ele) {

                    let value = (ele['value']) ? ele['value'] : '',
                        currency = '',
                        dataCurrency = ele['currency'];

                    if (dataCurrency && value)
                        currency = translateCurrency.currency[dataCurrency]['symbol'];

                    if (ele['name'] == 'amount') {
                        form.find('.receiptAmount .amount').html('<p class="ml-1 mr-1" dir="ltr">' + number_format(value) + '</p>' + ' ' + currency);
                        amountExist = true;
                    }
                    else {
                        if (ele['type'] == 'select') {
                            value = ele['receipt_relation'] ? ele['receipt_relation']['field_content'] : '';
                        }
                        if (ele['is_amount'] == 1)
                            value = '<p class="ml-1 mr-1" dir="ltr">' + number_format(value) + '</p>';
                        field += `<div class="" style="height: ${ele.number_of_lines * 1.5}em;overflow: hidden;">
                     
                        <label class="d-flex"><b class="text-dark">${field_translation[ele['name']]} : </b>${value + ' ' + currency}</label>
                      </div>`;
                    }

                    form.find('.receiptBodyView').html(field);

                });

                if (amountExist)
                    form.find('.receiptAmount').show();


                form.find('.formName').html(receiptList.form.name);
                form.find('.receiptDate').html($.format.date(receiptList['created_at'], "dd/MM/yyyy"));


                form.find('.receiptCode').html(code.replace("  " + $.format.date(receiptList['created_at'], "yyyy"), ""));

                generateBarcode(form, code);


                $('#modalViewReceipt').modal('show')
            });


        });

        //open modal view receipt
        dataTableReceipt.on('click', 'tr .annulReceipt', function () {

            let row = $(this).parents('tr'),
                data = dataTableReceipt.row(row).data();


            Swal.fire({
                title: translateConfirm,
                icon: 'error',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonText: translate.annul,
                confirmButtonText: translate.ok,
            }).then((result) => {
                if (result.isConfirmed) {

                    annulReceipt(data.id, function (response) {

                        dataTableReceipt.destroy();
                        reload_datatable_receipt();
                        Swal.fire(
                            response.STATUS,
                            response.MESSAGE,
                            response.STATUS.toLowerCase()
                        );
                    });
                }
            })


        });
    }

    $('#modalCreateReceipt').on('show.bs.modal', function (e) {
        let modal = $(this),
            arraySelectField = [],
            formId = 1;


        formFieldListByForm(formId, (data) => {
            let fields = data.form_field,
                html = '<input type="hidden" name="form_id" value="' + data.id + '">';

            formTitle = data.name;
            dataTablePrefix = data.prefix;

            $.each(fields, function (i, ele) {
                let fieldRequired = '',
                    fieldValidation = '',
                    type = receipt_type(ele.type);


                if (receipt_validation(ele.type) != '')
                    fieldValidation = `data-parsley-type="${receipt_validation(ele.type)}"`;

                if (ele.required == 1)
                    fieldRequired = 'data-parsley-required';


                let element = `<div class="col-sm-9">
                                    <input type="${type}" name="${ele.name}" step="0.01" data-numbrerOfLine="${ele.number_of_lines}" class="form-control elementPreview"  
                                         data-currency="${ele.currency}" data-isAmount="${ele.is_amount}" ${fieldRequired} ${fieldValidation} placeholder="${field_translation[ele.name]}">
                              </div>`;
                if (ele.type === 'select') {

                    element = `<div class="col-sm-7">
                                    <select class="form-control elementPreview" data-live-search="true" data-numbrerOfLine="${ele.number_of_lines}" name="${ele.name}" data-parsley-type="integer" ${fieldRequired}></select>
                              </div>
                              `;
                    if (ele.name == 'customer')
                        element += `<button type="button" data-toggle="modal" data-target="#modalCreateCustomer" class="btn btn-info"><i class="fa fa-plus"></i></button>`;

                }
                if (ele.has_field_relation && ele.has_field_relation != null) {

                    arraySelectField[i] = {
                        "field": ele.name,
                        "table": ele.has_field_relation.table_type,
                        "table_field": ele.has_field_relation.table_field
                    }

                }
                html += `<div class="form-group row">
                             <label class="col-sm-3 control-label col-form-label">${field_translation[ele.name]}</label>
                            ${element}
                          </div>`;
            });
            modal.find('.modal-body').html(html);

            $.each(arraySelectField, function (i, ele) {
                if (ele != null && ele)
                    GetTableList(ele.table, function (data_relation) {
                        let opt = '';
                        $.each(data_relation, function () {
                            opt += `<option value="${this.id}">${this[ele.table_field]}</option>`;
                        });

                        modal.find('[name="' + ele.field + '"]').html(opt).selectpicker('refresh');
                    });
            })


        })
    })

});

$(document).on('keyup', '#formCreateReceipt [name="amount"]', function () {

    let form = $('#formCreateReceipt'),
        amount = $(this).val().split("."),
        amount_in_letters = form.find('[name="amount_in_letters"]');
    if (amount_in_letters.length) {

        writtenNumber.defaults.lang = theLanguage;

        let letr = writtenNumber(amount[0]) + ' ' + translateCurrency.currency[$(this).attr('data-currency')]['name'];
        if (amount[1]) {

            if (amount[1].length == 1)
                amount[1] = amount[1] + '0';

            letr += ' ' + translateAnd + ' ' + writtenNumber(amount[1]) + ' ' + translateCurrency.centimes;
        }

        amount_in_letters.val(letr)

    }

});

$(document).on('click', '.receiptStatus', function () {
    dataTableReceipt.destroy();
    reload_datatable_receipt();


});


$(document).on('click', '#modalCreateReceipt .viewReceipt', function () {
    let form = $(this).parents('form'),
        formView = $('#formViewReceipt'),
        field = '',
        code = dataTablePrefix + '00000000',
        amountExist = false;


    formView.find('.receiptCopy').hide();
    formView.find('.receiptAmount').hide();
    formView.find('.printReceipt').hide().attr('href', '');

    $.each(form.find('.elementPreview[name]'), function () {

        let ele = $(this),
            value = ele.val(),
            currency = '',
            dataCurrency = ele.attr('data-currency'),
            isAmount = ele.attr('data-isAmount');

        if (dataCurrency && value)
            currency = translateCurrency.currency[dataCurrency]['symbol'];


        if (ele.attr('name') == 'amount') {
            formView.find('.receiptAmount .amount').html('<p class="ml-1 mr-1" dir="ltr">' + number_format(value) + '</p>' + ' ' + currency);
            amountExist = true
        }
        else {
            if (ele.is('select')) {
                value = ele.find('option:selected').text()
            }


            if (isAmount == 1)
                value = '<p class="ml-1 mr-1" dir="ltr">' + number_format(value) + '</p>';


            field += `<div class="text-left" style="height: ${ele.attr('data-numbrerOfLine') * 1.5}em;overflow: hidden;">
                        <label class="d-flex"><b class="text-dark">${field_translation[ele.attr('name')]} : </b>${value + ' ' + currency}</label>
                      </div>`;
        }

        formView.find('.receiptBodyView').html(field);

    });

    if (amountExist)
        formView.find('.receiptAmount').show();

    formView.find('.receiptDate').html($.format.date(new Date, "dd/MM/yyyy"));

    formView.find('.formName').html(formTitle);

    formView.find('.receiptCode').html('N°: ' + code);

    generateBarcode(formView, code);


    $('#modalViewReceipt').modal('show')

});


$(document).on('keyup keypress blur change', '#formViewReceipt #number_of_copy', function () {

    let form = $('#formViewReceipt'),
        id = form.find('[name="id"]').val(),
        copy = $(this);

    if (!copy.val() || copy.val() < 1 || copy.val() == null)
        copy.val(1);

    form.find('.printReceipt').attr('href', url + '/PdfController/printReceipt/' + id + '/' + copy.val());

});

// load datatable receipt
function reload_datatable_receipt() {


    let
        url_datatable_receipt = "/receipts/datatable",
        status = $('.receiptStatus button.active').attr('data-status'),
        data_list_receipt = {
            status: status,
            "_token": $('[name="_token"]').val()
        },
        columns = [
            {
                "data": "id", "render": function (data, type, row, meta) {
                    return meta.row + 1
                }
            },
            {
                "data": "code", "render": function (data, type, row) {

                    return row['code'].replace("  " + $.format.date(row['created_at'], "yyyy"), "");
                }
            },
            {
                "data": "customer", "render": function (data, type, row) {
                    let customer = '';
                    if (row['receipt_field'].length > 0)
                        $.each(row['receipt_field'], function () {
                            if (this.name == 'customer') {
                                if (!this.receipt_relation)
                                    return customer = this.value;

                                customer = this.receipt_relation.customerName
                            }
                        });

                    return customer;
                }
            },
            {
                "data": "status", render: function (data, type, row) {
                    let badge = 'badge badge-danger';

                    if (row['status'] == 'valid')
                        badge = 'badge badge-success';

                    return `<span class="${badge}">${row['status']}</span>`;
                }
            },
            {"data": "form.name"},
            {"data": "created_at", "visible": false},
            {
                "data": "action", "orderable": false, "searchable": false,
                "render": function (data, type, row) {
                    let list = `<div class="btn-group">
                                  <button class="btn btn-outline-info btn-sm  dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i>
                                  </button>
                                  <div class="dropdown-menu  dropdown-menu-right" x-placement="bottom-start">`

                    list += `<button class="dropdown-item viewReceipt" type="button"> <i class='fa fa-eye text-primary'></i> ${translate.view}</button>`;

                    if (permission['annul_receipt'] && status == "valid")
                        list += `<button class="dropdown-item annulReceipt" type="button"> <i class='fa fa-times text-danger'></i> ${translate.annul}</button>`;

                    list += `</div>
                                </div>`;

                    return list;
                }
            }
        ];
    dataTableReceipt = load_dtb('tableReceipt', url_datatable_receipt, data_list_receipt, columns);


}

// get list receipt by id

function getReceiptById(id, callback) {
    let route = '/receipts/list',
        data = {
            id: id,
            '_token': $('[name="_token"]').val()
        };

    sendPost(route, data)
        .then((response) => {
            if (response.STATUS === "SUCCESS") {

                if (callback)
                    callback(response.DATA)
            }
        })
        .catch((err) => console.log(err));

}


function annulReceipt(id, callback) {
    let url = '/receipts/annulReceipt',
        data = {
            id: id,
            '_token': $('[name="_token"]').val()
        };

    sendPost(url, data)
        .then((response) => {
            if (response.STATUS === "SUCCESS") {

                if (callback)
                    callback(response.DATA)
            }
        })
        .catch((err) => console.log(err));
}

// form submit add, update and delete receipt
$("#formCreateReceipt").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, (data) => {
        if (permission['print_receipts'])
            window = window.open(url + '/PdfController/printReceipt/' + data.DATA + '/' + 1);


        if ($(location).attr('href') == url + '/receipts')
            dataTableReceipt.ajax.reload();
    });
});
