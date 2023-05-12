var tables = {
    users: {
        fields: 'name',
    },
    customers: {
        fields: 'name',
    }
};
$(document).ready(function () {
    $('#tablesNameParent').hide();
    $('#tableColumnParent').hide();
    getTable(false, $('#tablesNameUpdate'), $('#tableColumnUpdate'));
    $('#tablesNameParentUpdate').hide();
    $('#tableColumnParentUpdate').hide();

});

// load datatable formFiled
function reload_datatable_form_field(form_field, view = false, callback) {


    let html = '';
    $.each(form_field, function (i, ele) {
        let buttons = '',
            required = '',
            show_in_report = '',
            checkAmount = '';
        if (ele.required == 1)
            required = 'checked';
        if (ele.fixed == 1)
            show_in_report = 'checked';
        if (ele.is_amount == 1)
            checkAmount = 'checked';

        if (formPermission['update_form_fields'])
            buttons += `<button class="btn btn-warning updateFormField"  type="button" data-id='${ele.id}'>
                                    <i class="fa fa-edit"></i></button>`;

        if (formPermission['delete_form_fields'])
            buttons += `
                                    <button class="btn btn-danger genericDeleteModalBtn"  type="button" data-action='/form_fields/delete' data-id='${ele.id}' >
                                    <i class="fa fa-trash"></i></button>`;


        html += `<tr id="${ele.id}" >
                                    <td>${field_translation[ele.name]}</td>
                                    <td>${field_type_translation[ele.type]}</td>
                                    <td>${ele.number_of_lines}</td>
                                    <td>
                                        <div class="switch mt-1">
                                            <label>
                                                <input type="checkbox" disabled ${required} >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="switch mt-1">
                                            <label>
                                                <input type="checkbox" disabled ${show_in_report} >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="switch mt-1">
                                            <label>
                                                <input type="checkbox" disabled ${checkAmount} >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>

                                    <td>${ele.currency}</td>`;
        if (!view)
            html += ` <td class="text-center">${buttons}</td>`;
        html += `</tr>`


    });
    if (callback)
        callback(html)


}

$(document).on('click', '.updateFormField', function () {
    let id = $(this).attr('data-id'),
        formUpdateFormField = $('#formUpdateFormField');

    formFieldList(id, (data) => {
        formUpdateFormField.find("[name='id']").val(data.id);
        formUpdateFormField.find("[name='name']").val(data.name);
        formUpdateFormField.find("[name='number_of_lines']").val(data.number_of_lines);
        formUpdateFormField.find("[name='type']").selectpicker('val', data.type);
        if (data.type == 'select') {
            $('#tablesNameParentUpdate').show();
            $('#tableColumnParentUpdate').show();
            getTable(data.has_field_relation.table_type, $('#tablesNameUpdate'), $('#tableColumnUpdate'));
            getTableFields(data.has_field_relation.table_type, $('#tableColumnUpdate'), data.has_field_relation.table_field);
        } else {
            $('#tablesNameParentUpdate').hide();
            $('#tableColumnParentUpdate').hide();
        }

        formUpdateFormField.find("[name='required']").attr('checked', false);
        formUpdateFormField.find("[name='fixed']").attr('checked', false);

        if (data.required == 1)
            formUpdateFormField.find("[name='required']").attr('checked', true);
        if (data.fixed == 1)
            formUpdateFormField.find("[name='fixed']").attr('checked', true);


        let currencyRow = formUpdateFormField.find('.currencyRow');



        formUpdateFormField.find("[name='is_amount']").prop('checked', false);

        currencyRow.attr('hidden', true);


        if (data.is_amount == 1){
            formUpdateFormField.find("[name='is_amount']").prop('checked', true);

            currencyRow.attr('hidden', false);
        }


        currencyRow.find('[name="currency"]').selectpicker('val', data.currency);

        $('#modalUpdateFormField').modal('show')

    })

});


function formFieldList(id, callback) {
    let url = '/form_fields/list',
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


// form submit add, update and delete form field
$("#formCreateFormField").on('submit', function (e) {
    e.preventDefault();
    let required = $(this).find('[name="required"]'),
        required_field = '',
        buttons = '',
        fixed = $(this).find('[name="fixed"]'),
        show_in_report = '',
        is_amount = $(this).find('[name="is_amount"]'),
        checkAmount = '';

    if (required.is(':checked'))
        required_field = 'checked';

    if (fixed.is(':checked'))
        show_in_report = 'checked';
    if (is_amount.is(':checked'))
        checkAmount = 'checked';


    form_submit(this, (response) => {
        if (formPermission['update_form_fields'])
            buttons += `<button class="btn btn-warning updateFormField mr-1"  type="button" data-id='${response.DATA.id}'>
                                    <i class="fa fa-edit"></i></button>`;
        if (formPermission['delete_form_fields'])
            buttons += `<button class="btn btn-danger genericDeleteModalBtn"  type="button" data-action='/form_fields/delete' data-id='${response.DATA.id}' >
                                    <i class="fa fa-trash"></i></button>`;

        let currencyField = '';
        if (response.DATA.currency)
            currencyField = response.DATA.currency;

        $('#navFormFieldsUpdate  .FormFieldTable tbody').append(` <tr id="${response.DATA.id}" >
                                    <td>${response.DATA.name}</td>
                                    <td>${field_type_translation[response.DATA.type]}</td>
                                    <td>${response.DATA.number_of_lines}</td>
                                    <td>
                                        <div class="switch mt-1">
                                            <label>
                                                <input type="checkbox" disabled ${required_field} >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="switch mt-1">
                                            <label>
                                                <input type="checkbox" disabled ${show_in_report} >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="switch mt-1">
                                            <label>
                                                <input type="checkbox" disabled ${checkAmount} >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    
                                    <td>${currencyField}</td>
                                    <td class="text-center">${buttons}</td>
                                </tr>`);

        dataTableForm.ajax.reload();
    });


});


// form submit add, update and delete form field
$("#formUpdateFormField").on('submit', function (e) {
    e.preventDefault();

    let required = $(this).find('[name="required"]'),
        required_field = '',
        buttons = '',
        fixed = $(this).find('[name="fixed"]'),
        show_in_report = '',
        is_amount = $(this).find('[name="is_amount"]'),
        checkAmount = '';

    if (required.is(':checked'))
        required_field = 'checked';

    if (fixed.is(':checked'))
        show_in_report = 'checked';
    if (is_amount.is(':checked'))
        checkAmount = 'checked';

    form_submit(this, (response) => {
        if (formPermission['update_form_fields'])
            buttons += `<button class="btn btn-warning updateFormField mr-1"  type="button" data-id='${response.DATA.id}'>
                                    <i class="fa fa-edit"></i></button>`;
        if (formPermission['delete_form_fields'])
            buttons += `<button class="btn btn-danger genericDeleteModalBtn"  type="button" data-action='/form_fields/delete'data-id='${response.DATA.id}' >
                                    <i class="fa fa-trash"></i></button>
                                    `;


        $('#navFormFieldsUpdate  .FormFieldTable tbody tr[id="' + response.DATA.id + '"]').html(`
                                    <td>${response.DATA.name}</td>
                                    <td>${response.DATA.type}</td>
                                    <td>${response.DATA.number_of_lines}</td>
                                      <td>
                                        <div class="switch mt-1">
                                            <label>
                                                <input type="checkbox" disabled ${required_field} >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                      <td>
                                        <div class="switch mt-1">
                                            <label>
                                                <input type="checkbox" disabled ${show_in_report} >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                      <td>
                                        <div class="switch mt-1">
                                            <label>
                                                <input type="checkbox" disabled ${checkAmount} >
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </td>
                                    
                                    <td>${response.DATA.currency}</td>
                                    <td class="text-center">${buttons}</td>
                                `);

        dataTableForm.ajax.reload();

    });
});


/**
 * send delete information in form of post
 */
$(document).on("submit", '#genericDeleteModal form', function (event) {
        event.preventDefault();
        form_submit(this, (response) => {
            $('#navFormFieldsUpdate  .FormFieldTable tbody tr[id="' + response.DATA + '"]').remove()
        });
    }
);

function getFeildType() {
    var fieldType = $('#fieldType');
    var fieldTypeUpdate = $('#fieldTypeUpdate');
    sendPost('/GlobalController/GetEnumValues', {table: 'form_fields', column: 'type'})
        .then((response) => {
            if (response.STATUS === "SUCCESS") {
                let data = response.DATA, opt = '';
                $.each(data, (i) => {
                    let selected = (data[i] == 'text') ? 'selected' : '';
                    opt += `<option  value="${data[i]}"  ${selected} >${field_type_translation[data[i]]}</option>`;
                });
                fieldType.html(opt).selectpicker('refresh');
                fieldTypeUpdate.html(opt).selectpicker('refresh');
            }
        })
        .catch((err) => console.log(err));
}

getFeildType();


$(document).on("change", '#fieldType', function (event) {
        event.preventDefault();

        let is_amountRow = $('.is_amountRow'),
            currencyRow = $('.currencyRow');

        is_amountRow.attr('hidden', true);
        currencyRow.attr('hidden', true);
        is_amountRow.find('[name="is_amount"]').attr('checked', false);
        currencyRow.find('[name="currency"]').selectpicker('val', '');

        if ($(this).val() == 'select') {
            $('#tablesNameParent').show();
            $('#tableColumnParent').show();
            getTable(false, $('#tablesName'), $('#tableColumn'));
        } else {
            $('#tablesNameParent').hide();
            $('#tableColumnParent').hide();

            if ($(this).val() == 'integer' || $(this).val() == 'decimal')
                is_amountRow.attr('hidden', false);

        }
    }
);

$(document).on("change", '#fieldTypeUpdate', function (event) {
        event.preventDefault();

        let is_amountRow = $('.is_amountRow'),
            currencyRow = $('.currencyRow');

        is_amountRow.attr('hidden', true);
        currencyRow.attr('hidden', true);
        is_amountRow.find('[name="is_amount"]').prop('checked', false);
        currencyRow.find('[name="currency"]').selectpicker('val', '');

        if ($(this).val() == 'select') {
            $('#tablesNameParentUpdate').show();
            $('#tableColumnParentUpdate').show();
            getTable(false, $('#tablesNameUpdate'), $('#tableColumnUpdate'));

        } else {
            $('#tablesNameParentUpdate').hide();
            $('#tableColumnParentUpdate').hide();


            if ($(this).val() == 'integer' || $(this).val() == 'decimal')
                is_amountRow.attr('hidden', false);
        }
    }
);

function getTable(table_selected = false, selector = '', fieldSelector = '') {
    let opt = '', lastTable;
    for (let table in tables) {
        opt += `<option  value="${table}">${table_with_field_tanslation[table]}</option>`;
        lastTable = table;
    }
    selector.html(opt).selectpicker('refresh');
    selector.selectpicker('val', (table_selected) ? table_selected : lastTable);
    getTableFields(lastTable, fieldSelector)
}

function getTableFields(table, selector = '', field_selected = false) {
    let opt = '', lastField;
    for (let field in tables[table]) {
        opt += `<option  value="${tables[table][field]}">${table_with_field_tanslation[tables[table][field]]}</option>`;
        lastField = tables[table][field];
    }
    selector.html(opt).selectpicker('refresh');
    selector.selectpicker('val', (field_selected) ? field_selected : lastField);
}

$(document).on("change", '#tablesName', function (event) {
        event.preventDefault();
        getTableFields($(this).val(), $('#tableColumn'));
    }
);

$('#modalCreateFormField').on('shown.bs.modal', function () {
    let form = $('#formCreateFormField');
    delete_warning(form);

    checkIsAmount(form);

});


$(document).on("change", '[name="is_amount"]', function () {
    let currencyRow = $('.currencyRow');

    if ($(this).is(':checked')) {
        currencyRow.attr('hidden', false);

        currencyRow.find('[name="currency"]').selectpicker('val', 'DZD');

    }
    else {
        currencyRow.attr('hidden', true);

        currencyRow.find('[name="currency"]').selectpicker('val', '');

    }
});

function checkIsAmount(form) {
    let is_amountRow = $('.is_amountRow'),
        currencyRow = $('.currencyRow');

    is_amountRow.attr('hidden', true);
    currencyRow.attr('hidden', true);
    is_amountRow.find('[name="is_amount"]').prop('checked', false);
    currencyRow.find('[name="currency"]').selectpicker('val', '');

    if (form.find('select.fieldType').val() == 'integer' || form.find('select.fieldType').val() == 'decimal')
        is_amountRow.attr('hidden', false);

}



