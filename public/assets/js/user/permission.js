function drowTabContent(menus , userId){
    let tabC = `<ul class="nav nav-tabs tabs-vertical" role="tablist">`;
    let rowC = ``;
    $.each(menus, function (index, menu) {
        tabC += tabComponent(menu['name'],menu['icon']);
        rowC += tabForm(menu['permissions'] ,menu['name'],menu['id'] ,userId);
    });
    tabC += `</ul>`;

    $('.userPermissionTabs').html(tabC);
    $('.tab-content').html(rowC);
    $('#modalUserPermission .nav-item a')[0].click();
}
function tabForm(permissions , menu , menuId , userId){
    let checked,can_update;
    let Form = FormHeader(menu ,menuId ,userId);
    $.each(permissions, function (index, permission) {
        checked = (permission['activated'] == 1) ? 'checked' : '';
        can_update = (permission['can_update'] == 1) ? '' : 'disabled';
        Form += rowComponent(permission['name'], checked,can_update);
    });
    Form += FormFooter();
    return Form;
}
function FormHeader(menu ,menuId , userId){
    let Header = ` <div class="tab-pane  p-20 col-sm-12" id="${menu}" role="tabpanel">`;
    Header += `<form method="POST" action="${url + '/users/updatePermissions'}" accept-charset="UTF-8" class="form-horizontal">`;
    Header += `<div class="row">`;
    Header += hiddenRowComponent(menuId , userId);
    return Header;
}
function FormFooter(){
    let Footer = `</div>`;
    Footer +=   `<div class="col-12 text-center">`;
    Footer +=       `<button type="button" class="btn btn-warning btn-lg formUserPermission">${translate["update"]}</button>`;
    Footer +=     `</div>`;
    Footer +=  `</form>`;
    Footer += `</div>`;
    return Footer;
}
function tabComponent(tabname,tabIcon) {
    let tab;
    tab = `<li class="nav-item">`;
    tab +=      `<a class="nav-link " data-toggle="tab" href="#${tabname}" role="tab">`;
    tab +=          ` <span class="hidden-sm-down">${menu_translation[tabname]}</span>`;
    tab +=          ` <i class="${tabIcon} hidden-icon"></i>`;
    tab +=      `</a>`;
    tab += `</li>`;
    return tab;
}
function rowComponent(rowName, checked = '',can_update) {
    let row;
    row = `<div class="col-sm-6">`;
    row +=     `<div class="form-group row">`;
    row +=          `<label class="col-sm-6 text-center control-label col-form-label">${permission_translation[rowName]}</label>`;
    row +=          `<div class="col-sm-6">`;
    row +=              `<label class="switch">`;
    row +=                      `<input type="checkbox" name="${rowName}" ${checked} ${can_update}> <div class="slider"></div>`;
    row +=              ` </label>`;
    row +=          `</div>`;
    row +=      `</div>`;
    row += `</div>`;
    return row;
}
function hiddenRowComponent(menuId,userId) {
    let row =  `<input type="text" name="menuId" value="${menuId}" hidden>`;
    row +=  `<input type="text" name="userId" value="${userId}" hidden>`;
    return row;
}
// form update user permission
$(document).on('click', ".formUserPermission",function (e) {
    e.preventDefault();
    send_permission($(this).parents('form')[0]);
});
let send_permission = (form, callback) => {

    let data = new FormData(form),fieldName,
        submit_url = $(form).attr("action");

    $(form).parsley().validate();
    if ($(form).parsley().isValid()) {
        $(form).find('[type="submit"]').attr("disabled", true);
        sendPostFormData(submit_url, data)
            .then((response) => {
                if (response.STATUS === "SUCCESS") {
                    if (callback)
                        callback(response);
                    $(form).find("[name]").prop('checked', false);

                    $.each(response['DATA'], function (index, permission) {
                        fieldName = permission['name'];
                        $(form).find('[name="'+fieldName+'"]').prop('checked',true);
                    });
                    delete_validate_error(form);
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

$(document).on('change', ".formUserPermission",function (e) {
    e.preventDefault();
    send_permission($(this).parents('form')[0]);
});


$(document).on('change', '[name="add_users"]',function (e) {
    if ($(this).is(':checked'))
        $('[name="update_users"]').prop('checked',true);
});

$(document).on('change', '[name="update_users"]',function (e) {
    if (!$(this).is(':checked')){
        $('[name="add_users"]').prop('checked',false);
    }
});


