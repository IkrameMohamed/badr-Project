let dataTableUser,
    url_datatable_customer = "/users/datatable",
    data_list_customer = {
        "_token": $('[name="_token"]').val()
    };

$(document).ready(function () {


    reload_datatable();
    dataTableUser.on('click', 'tr .viewUser', function () {
        let form = $('#formViewUser'),
            row = $(this).parents('tr'),
            data = dataTableUser.row(row).data();
        reset_form(form);
        form.find('.dropUserImage').html(`<input type="file" name="UserImage" class="dropify"
                               data-height="100" disabled
                               data-default-file="${asset}files/users/${data.id}/profiel.jpg">`);
        resetDropify(form.find('.dropify'));
        if (data.id == 1 || data.id == 2)
            getRoleOption(form, data.role_id);
        else
            getRolesOption(form, data.role_id);
        form.find("[name='UserName']").val(data.name);
        form.find("[name='UserEmail']").val(data.email);
        form.find('[name="UserActive"]').prop("checked", data.active);
        $('#modalViewUser').modal('show');
    });

    dataTableUser.on('click', 'tr .updateUser', function (e) {
        e.stopPropagation();
        let form = $('#formUpdateUser'),
            row = $(this).parents('tr'),
            data = dataTableUser.row(row).data();
        reset_form(form);

        form.find("[name='id']").val(data.id);
        form.find('.dropUserImage').html(`<input type="file" name="UserImage" class="dropify"
                               data-height="100"
                               data-default-file="${asset}files/users/${data.id}/profiel.jpg">`);
        resetDropify(form.find('.dropify'));

        if (data.id == 1 || data.id == 2){
            getRoleOption(form, data.role_id);
            form.find('[name="UserActive"]').prop("checked", data.active).attr('disabled',true);
        }
        else{

            getRolesOption(form, data.role_id);
            form.find('[name="UserActive"]').prop("checked", data.active).attr('disabled',false);
        }
        form.find("[name='UserName']").val(data.name);
        form.find("[name='UserEmail']").val(data.email);
        $('#modalUpdateUser').modal('show');
    });

    dataTableUser.on('click', 'tr .updatUserPermission', function () {
        let row = $(this).parents('tr'),
            data = dataTableUser.row(row).data();
        sendPost('/users/permissions', {id: data.id})
            .then((response) => {
                if (response.STATUS === "SUCCESS") {
                    drowTabContent(response['DATA'], data.id);
                    $('#modalUserPermission').modal('show');
                }
            })
            .catch((err) => console.log(err));
    });
});

// load datatable users
function reload_datatable() {

    let columns = [
        {
            "data": "id", "render": function (data, type, row, meta) {
                return (row['active']) ? meta.row + 1 : '<i class="fa fa-lock " style="color:red"aria-hidden="true"></i>';
            }
        },
        {"data": "name"},
        {"data": "email", "className": "my_class"},
        {"data": "created_at", "visible": false},
        {
            "data": "name", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                let list = `    <div class="dropdown">
                                     <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         ${translate["action"]}
                                    </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">`;

                list += `<button class="dropdown-item viewUser" type="button"> <i class='fa fa-eye text-primary'></i> ${translate["view"]}</button>`;

                // admin and sysadmin

                if (userPermission['update_users']) {
                    list += `<button class="dropdown-item updateUser" type="button"> <i class='fa fa-edit text-warning'></i> ${translate["update"]}</button>`;
                }

                if (row["id"] != 1 && row["id"] != 2 &&  user_id != row["id"]) {
                    if (userPermission['update_users']) {
                        list += ` <button class="dropdown-item genericDatatBtn" data-action="/users/refreshUserRole"  data-role_id="${row['role_id']}"  data-user_id="${row['id']}" type="button"> <i class="fas fa-sync-alt"></i> ${translate["reset_permission"]}</button>`;

                        list += ` <button class="dropdown-item updatUserPermission" type="button"> <i class='fa fa-lock text-success'></i> ${translate["permission"]}</button>`;
                    }
                    if (userPermission['delete_users'])
                        list += `<button class="dropdown-item genericDeleteModalBtn"  type="button" data-id='${row["id"]}' data-action='/users/delete'>
                                     <i class='fa fa-trash text-danger'></i> ${translate["delete"]}</button>`;
                }
                list += `</div>
                                </div>`;
                return list;
            }
        }
    ];
    dataTableUser = load_dtb('tableUsers', url_datatable_customer, data_list_customer, columns);

}

// form submit  update
$("#formUpdateUser").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableUser.ajax.reload();
    });
});

// form submit add
$("#formCreateUser").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableUser.ajax.reload();
    });
});

// form delet user
$("#genericDeleteModal form").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableUser.ajax.reload();
    });
});

$(".CreatUserBtn").on('click', function () {
    $("#formCreateUser")[0].reset();
    getRolesOption($("#formCreateUser"))
});

function getRolesOption(selector, field_selected = false) {
    let route = '/roles/read';
    sendPost(route, {}).then((response) => {
        if (response.STATUS === "SUCCESS") {
            let data = response.DATA, opt = '', lastField;
            $.each(data, function (index, role) {
                opt += `<option  value="${role['id']}">${role['name']}</option>`;
                lastField = role['id'];
            });
            selector.find("[name='allRoles']").html(opt).selectpicker('refresh');
            selector.find("[name='allRoles']").selectpicker('val', (field_selected) ? field_selected : lastField);
        }
    }).catch((err) => console.log(err));
}

function getRoleOption(selector, roleId) {
    let route = '/roles/read';
    sendPost(route, {id: roleId}).then((response) => {
        if (response.STATUS === "SUCCESS") {
            let data = response.DATA, opt = '';
            opt += `<option  value="${response.DATA.id}"  >${response.DATA.name}</option>`;
            selector.find("[name='allRoles']").html(opt).selectpicker('refresh');
            selector.find("[name='allRoles']").selectpicker('val', response.DATA.id);
        }
    }).catch((err) => console.log(err));
}
