let dataTableCustomer,
    url_datatable_customer = "/customers/datatable",
    data_list_customer = {
        "_token": $('[name="_token"]').val()
    };

$(document).ready(function () {
    reload_datatable();
    //open modal view customer
    dataTableCustomer.on('click', 'tr .viewCustomer', function () {
        let form = $('#formViewCustomer'),
            row = $(this).parents('tr'),
            data = dataTableCustomer.row(row).data();
        reset_form(form);

        $(form).find("#label_name").text(data.name);

        $('#modalViewCustomer').modal('show')
    });
    //open modal update customer
    dataTableCustomer.on('click', 'tr .updateCustomer', function (e) {

        let form = $('#formUpdateCustomer'),
            row = $(this).parents('tr'),
            data = dataTableCustomer.row(row).data();

        reset_form(form);

        $(form).find("[name='id']").val(data.id);

        $(form).find("[name='name']").val(data.name);

        $('#modalUpdateCustomer').modal('show');
        e.stopPropagation();
    });

});

// load datatable customer
function reload_datatable() {
    let columns = [
        {
            "data": "id", "render": function (data, type, row, meta) {
                return meta.row + 1
            }
        },
        {"data": "name"},
        {"data": "created_at" },
        {
            "data": "action", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                let list = `<div class="btn-group">
                                  <button class="btn btn-outline-info btn-sm  dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i>
                                  </button>
                                  <div class="dropdown-menu  dropdown-menu-right" x-placement="bottom-start">
                                   `;
                    list += ` <button class="dropdown-item viewCustomer" type="button"> <i class='fa fa-eye text-primary'></i> ${translate.view}</button>`;

                if (customerPermission['update_customers'])
                    list += `<button class="dropdown-item updateCustomer" type="button"> <i class='fa fa-edit text-warning'></i> ${translate.update}</button>`;

                if (customerPermission['delete_customers'])
                    list += `<button class="dropdown-item genericDeleteModalBtn"  type="button" data-id='${row["id"]}' data-action='/customers/delete'>
                                     <i class='fa fa-trash text-danger'></i> ${translate.delete}</button>`;

                list += `</div>
                                </div>`;

                return list;
            }
        }
    ];
    dataTableCustomer = load_dtb('tableCustomer', url_datatable_customer, data_list_customer, columns);
}

// form submit add, update and delete customer
$("#formUpdateCustomer,#genericDeleteModal form").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableCustomer.ajax.reload();
    });
});
