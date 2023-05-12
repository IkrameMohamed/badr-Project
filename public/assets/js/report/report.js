let dataTableReport;
let amountColumns = [];

$(document).ready(function () {


    reload_datatable();

    $('#date-range').datepicker({
        toggleActive: true,
        format: 'dd/mm/yyyy'
    });
});

$(document).on('click', '.receiptStatus button,#SearchReceipt', function () {

    dataTableReport.destroy();
    reload_datatable();
});

$(document).on('change', '[name="formField"]', function () {

    let field = $(this),
        fieldType = '',
        route = "/form_fields/list",
        data = {
            id: field.val(),
            "_token": $('[name="_token"]').val()
        };
    $('#selectFieldType').html('');

    if (field.val() && field.val() != null && field.val() != 'all' ) {
        sendPost(route, data)
            .then((response) => {
                if (response.STATUS === "SUCCESS") {
                    let ele = response.DATA,
                        fieldValidation = 'data-parsley-type="' + receipt_validation(ele.type) + '"',
                        type = receipt_type(ele.type);


                    fieldType = `<input type="${type}" name="field_type" class="form-control" ${fieldValidation} placeholder="${field_translation[ele.name]}">`;
                    if (ele.type === 'select') {

                        fieldType = `<select class="form-control" data-live-search="true" name="field_type" data-parsley-type="integer" ></select>`;

                        if (ele.has_field_relation && ele.has_field_relation != null) {

                            let table = ele.has_field_relation.table_type,
                                table_field = ele.has_field_relation.table_field;

                            GetTableList(table, function (data_relation) {
                                let opt = '';
                                $.each(data_relation, function () {
                                    opt += `<option data-name="${this[table_field]}" value="${this.id}">${this[table_field]}</option>`;
                                });

                                $('[name="field_type"]').html(opt).selectpicker('refresh');
                            });

                        }
                    }


                    $('[name="field_type"]').show()
                    $('#selectFieldType').html(fieldType)
                }


            })
            .catch((err) => console.log(err));

    }
    else {
        $('[name="field_type"]').hide()
    }


});

// load datatable report
function reload_datatable() {

    let tableHeaders = '',
        tableBody = '',
        tableFooter = '',
        tableReport = $("#tableReport"),

        start = $('[name="start"]'),
        end = $('[name="end"]'),
        formFieldSelected = $('[name="formField"]'),
        field_type = $('[name="field_type"]'),
        statusActive = $('.receiptStatus button.active'),

        url_datatable_report = "/reports/datatable",
        data_list_report = {
            start: start.val(),
            end: end.val(),
            formFieldSelected: formFieldSelected.val(),
            field_type: field_type.val(),
            status: statusActive.attr('data-status'),
            "_token": $('[name="_token"]').val()
        };

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: url + url_datatable_report,
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        },
        data: data_list_report,
        success: function (response) {
            let
                data = response.DATA.original.data,
                opt = '<option value="all"> ' + translateAll + '</option>';

            // start reset table header


            $.each(response.HEADER, function (i, val) {
                let fieldName = val.translate;

                if (val.is_field == 1) {
                    opt += '<option data-name="' + val.name + '" value="' + val.id + '"> ' + fieldName + '</option>';
                }
                if (val.is_amount == 1)
                    amountColumns.push(i);

                tableHeaders += "<th>" + fieldName + "</th>";
                tableFooter += "<th></th>";
            });

            $.each(data, function (i, val) {

                let tableBodyTr = '',isAmount = '';

                $.each(response.HEADER, function (i, ele) {
                    isAmount = (ele.is_amount) ? 'isNumber' : '';

                    let value = (val[ele.name]) ? val[ele.name] : '';

                    if (ele.is_amount && value == '')
                        value = '0,00' ;

                    tableBodyTr += "<td class='" + isAmount +"'>" + value + "</td>";
                });
                if (field_type.val() && field_type.val() != null) {
                    let values = field_type.val();
                    if (field_type.is('select')) {
                        values = field_type.find('option:selected').attr('data-name')
                    }


                    let dataValue = val[formFieldSelected.find('option:selected').attr('data-name')] ;


                    if (dataValue.indexOf(values) > -1){

                        tableBody += '<tr>' + tableBodyTr + '</tr>';
                    }
                } else {
                    tableBody += '<tr>' + tableBodyTr + '</tr>';
                }
            });

            tableReport.empty();
            tableReport.append(`<thead class="bg-info text-white text-center ">
                                    <tr>${tableHeaders}</tr>
                                </thead>`);
            tableReport.append('<tbody>' + tableBody + '</tbody>');

            tableReport.append(`<tfoot class="bg-info text-white ">
                                    <tr>${tableFooter}</tr>
                                </tfoot>`);

            if (!formFieldSelected.val() || formFieldSelected.val() == null)
                $('[name="formField"]').html(opt).selectpicker('refresh');


            // end reset table header

            let message = statusActive.text();
            dataTableReport = dynamic_dtb(tableReport, message, amountColumns, amountColumns , true);


        },
        error: function (err) {
            console.log(err);
        }
    });
}



