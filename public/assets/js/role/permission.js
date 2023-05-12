function drowTabContent(menus , roleId){
    let tabC = `<ul class="nav nav-tabs tabs-vertical" role="tablist">`;
    let rowC = ``;
    $.each(menus, function (index, menu) {
        tabC += tabComponent(menu['name'],menu['icon']);
        rowC += tabForm(menu['permissions'] ,menu['name'],menu['id'] ,roleId);
    });
    tabC += `</ul>`;

    $('.rolePermissionTabs').html(tabC);
    $('.tab-content').html(rowC);
    $('#modalRolePermission .nav-item a')[0].click();
}
function tabForm(permissions , menu , menuId , roleId){
    let checked;
    let Form = FormHeader(menu ,menuId ,roleId);
    $.each(permissions, function (index, permission) {
        checked = (permission['activated'] == 1) ? 'checked' : '';
        Form += rowComponent(permission['name'], checked);
    });
    Form += FormFooter(roleId);
    return Form;
}
function FormHeader(menu ,menuId , roleId){
    let Header = ` <div class="tab-pane  p-20 col-sm-12" id="${menu}" role="tabpanel">`;
    Header += `<form method="POST" action="${url + '/roles/updatePermissions'}" accept-charset="UTF-8" class="form-horizontal">`;
    Header += `<div class="row">`;
    Header += hiddenRowComponent(menuId , roleId);
    return Header;
}
function FormFooter(roleId){
    let Footer = `</div>`;
    if(roleId != 1 && roleId != 2){
        Footer +=   `<div class="col-12 text-center">`;
        Footer +=       `<button type="button" class="btn btn-warning formRolePermission">${translate["update"]}</button>`;
        Footer +=     `</div>`;
    }
    Footer +=  `</form>`;
    Footer += `</div>`;
    return Footer;
}
function tabComponent(tabname,tabIcon) {
    let tab;
    tab = `<li class="nav-item">`;
    tab +=      `<a class="nav-link " data-toggle="tab" href="#${tabname}" role="tab">`;
    tab +=          ` <i class="${tabIcon}"></i>`;
    tab +=          ` <span class="hidden-sm-down">${menu_translation[tabname]}</span>`;
    tab +=      `</a>`;
    tab += `</li>`;
    return tab;
}
function rowComponent(rowName, checked = '') {
    let row;
    row = `<div class="col-sm-6">`;
    row +=     `<div class="form-group row">`;
    row +=          `<label class="col-sm-6 text-right control-label col-form-label">${permission_translation[rowName]}</label>`;
    row +=          `<div class="col-sm-6">`;
    row +=              `<label class="switch">`;
    row +=                      `<input type="checkbox" name="${rowName}" ${checked}> <div class="slider"></div>`;
    row +=              ` </label>`;
    row +=          `</div>`;
    row +=      `</div>`;
    row += `</div>`;
    return row;
}
function hiddenRowComponent(menuId,roleId) {
    let row =  `<input type="text" name="menuId" value="${menuId}" hidden>`;
    row +=  `<input type="text" name="roleId" value="${roleId}" hidden>`;
    return row;
}

// form update role permission
$(document).on('click', ".formRolePermission",function (e) {
    e.preventDefault();
    send_permission($(this).parents('form')[0], () => {

    });
});

let send_permission = (form, callback) => {

    let data = new FormData(form),
        submit_url = $(form).attr("action");

    $(form).parsley().validate();
    if ($(form).parsley().isValid()) {
        $(form).find('[type="submit"]').attr("disabled", true);
        sendPostFormData(submit_url, data)
            .then((response) => {
                if (response.STATUS === "SUCCESS") {
                    if (callback)
                        callback(response);
                    updateRoleFormUsers(response.DATA.roleId);
                    delete_validate_error(form);
                }
                if (response.STATUS === "ERROR") {
                    show_validate_error(response, form);
                }
                if (response.STATUS === "WARNING") {
                    show_warning(response, form);
                }
                $(form).find('[type="submit"]').attr("disabled", false);
            })
            .catch((err) => console.log(err));
    }
};


function updateRoleFormUsers(roleId){
    confirmationToast.fire({
        title: role_translation['update_role_successfully'],
        text: role_translation['do_you_want_to_update_all_users_permissions'],
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: role_translation['yes'],
        cancelButtonText:  role_translation['no'],
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            sendPost('/roles/updatePermitionForAllUsers', {roleId: roleId})
                .then((response) => {
                    if (response.STATUS === "SUCCESS") {
                        confirmationToast.fire(
                            role_translation['success'],
                            role_translation['users_permissions_update_successfully'],
                            'success'
                        )
                    }else{
                        confirmationToast.fire(
                            role_translation['error_pleace_contact_admin_for_mor_informations'],
                            'error'
                        )
                    }
                    console.log(response)
                })
                .catch((err) => console.log(err));
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            confirmationToast.fire(
                role_translation['notice'],
                role_translation['users_permissions_rest_the_same'],
                'warning'
            )
        }
    })
}
