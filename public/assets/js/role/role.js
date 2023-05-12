let dataTableRole,
    url_datatable_customer = "/roles/datatable",
    data_list_customer = {
        "_token": $('[name="_token"]').val()
    };

$(document).ready(function () {
    reload_datatable();

    dataTableRole.on('click', 'tr .viewRole', function () {
        let form = $('#formViewRole'),
            row = $(this).parents('tr'),
            data = dataTableRole.row(row).data();
        reset_form(form);

        form.find("[name='RoleName']").val(data.name);
        $('#modalViewRole').modal('show')
    });

    dataTableRole.on('click', 'tr .updateRole', function (e) {
        e.stopPropagation();
        let form = $('#formUpdateRole'),
            row = $(this).parents('tr'),
            data = dataTableRole.row(row).data();
        reset_form(form);
        form.find("[name='id']").val(data.id);
        form.find("[name='RoleName']").val(data.name);
        $('#modalUpdateRole').modal('show');
    });

    dataTableRole.on('click', 'tr .updateRolePermission', function () {
        let row = $(this).parents('tr'),
            data = dataTableRole.row(row).data();
        sendPost('/roles/permissions', {id: data.id})
            .then((response) => {
                if (response.STATUS === "SUCCESS") {
                    drowTabContent(response['DATA'], data.id);
                    $('#modalRolePermission').modal('show');
                }
            })
            .catch((err) => console.log(err));
    });
});

// load datatable Roles
function reload_datatable() {

    let columns = [
        {
            "data": "id", "render": function (data, type, row, meta) {
                return meta.row + 1
            }
        },
        {"data": "name"},
        {"data": "created_at", "visible": false},
        {
            "data": "name", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                let list = `<div class="dropdown">
                                     <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         ${translate["action"]}
                                    </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">`;
                    list += `<button class="dropdown-item viewRole" type="button"> <i class='fa fa-eye text-primary'></i> ${translate["view"]}</button>`;

                if (role_permission['update_roles']) {
                    list += `<button class="dropdown-item updateRole" type="button"> <i class='fa fa-edit text-warning'></i> ${translate["update"]}</button>`;

                    list += ` <button class="dropdown-item updateRolePermission" type="button"> <i class='fa  fa-lock text-success'></i> ${translate["permission"]}</button>`;
                }
                if (role_permission['delete_roles'] && $.isEmptyObject(row['users']))
                    list += `<button class="dropdown-item genericDeleteModalBtn"  type="button" data-id='${row["id"]}' data-action='/roles/delete'>
                                     <i class='fa fa-trash text-danger'></i> ${translate["delete"]}</button>`;
                list += `</div>
                                </div>`;
                return list;
            }
        }
    ];
    dataTableRole = load_dtb('tableRoles', url_datatable_customer, data_list_customer, columns);
}

// form add role
$("#formCreateRole").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableRole.ajax.reload();
    });
});

// form update role
$("#formUpdateRole").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableRole.ajax.reload();
    });
});

// form delet user
$("#genericDeleteModal form").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableRole.ajax.reload();
    });
});

