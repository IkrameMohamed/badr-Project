

$(document).ready(function () {
    getType($("#formCreateUser"));

});


// form submit add
$("#formCreateUser").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        window.location.href = "http://127.0.0.1:8000/";
    });
});

function getType(selector, field_selected = false) {
    let  opt = '', lastField;

    opt += `<option  value="MEN">MEN</option>`;
    opt += `<option  value="WOMEN">WOMEN</option>`;
    lastField = 'MEN';

    selector.find("[name='type']").html(opt).selectpicker('refresh');
    selector.find("[name='type']").selectpicker('val', (field_selected) ? field_selected : lastField);
}
