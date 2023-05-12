let dataTableForm,
    url_datatable_form = "/forms/datatable",
    data_list_form = {
        "_token": $('[name="_token"]').val()
    },
    form;

$(document).ready(function () {
    reload_datatable();
    //open modal view form
    dataTableForm.on('click', 'tr .viewForm', function () {
        form = $('#formViewForm');

        let row = $(this).parents('tr'),
            data = dataTableForm.row(row).data(),
            fields = 'no fields';
        reset_form(form);

        form.find("#label_name").text(data.name);
        form.find("#label_prefix").text(data.prefix);
        form.find("#label_number_length").text(data.number_length);
        form.find("#label_start").text(data.start);

        if (data.form_field) {
            formFieldListByForm(data.id,function (dataFormFiled) {
                reload_datatable_form_field(dataFormFiled.form_field ,true,function (html) {

                    form.find('#navFormFieldsView  .FormFieldTable tbody').html(html);
                });
            })


        }


        $('#modalViewForm').modal('show')
    });
    //open modal update form
    dataTableForm.on('click', 'tr .updateForm', function (e) {
        form = $('#formUpdateForm');

        let row = $(this).parents('tr'),
            data = dataTableForm.row(row).data(),
            disabled = false;
        if (data.one_receipt){

            disabled = true;
        }
        reset_form(form);

        form.find("[name='id']").val(data.id);
        form.find("button:submit").attr('disabled',disabled);

        form.find("[name='name']").attr('disabled',disabled).val(data.name);
        form.find("[name='prefix']").attr('disabled',disabled).val(data.prefix);
        form.find("[name='number_length']").attr('disabled',disabled).val(data.number_length);
        form.find("[name='start']").attr('disabled',disabled).val(data.start);

        if (data.form_field) {

            reload_datatable_form_field(data.form_field,false,function (html) {

                $('#navFormFieldsUpdate  .FormFieldTable tbody').html(html);

            });

        }



        $('#modalUpdateForm').modal('show');
        e.stopPropagation();
    });

});

// load datatable form
function reload_datatable() {


    let columns = [
        {
            "data": "id", "render": function (data, type, row, meta) {
                return meta.row + 1
            }
        },
        {"data": "name"},
        {"data": "prefix"},
        {"data": "number_length"},
        {"data": "created_at", "visible": false },
        {
            "data": "action", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                let list = `<div class="btn-group">
                                  <button class="btn btn-outline-info btn-sm  dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i>
                                  </button>
                                  <div class="dropdown-menu  dropdown-menu-right" x-placement="bottom-start">`;


                list += `<button class="dropdown-item viewForm" type="button"> <i class='fa fa-eye text-primary'></i> ${translate.view}</button>`;

                if (formPermission['update_forms'])
                list += `<button class="dropdown-item updateForm" type="button"> <i class='fa fa-edit text-warning'></i> ${translate.update}</button>`;


                list += `</div>
                                </div>`;

                return list;
            }
        }
    ];
    dataTableForm = load_dtb('tableForm', url_datatable_form, data_list_form, columns);


}


// form submit add, update and delete form
$("#formUpdateForm").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableForm.ajax.reload();
    });
});

