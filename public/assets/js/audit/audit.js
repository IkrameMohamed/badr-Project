let dataTableAudit;

$(document).ready(function () {
    reload_datatable();

    $('#date-range').datepicker({
        toggleActive: true,
        format: 'dd/mm/yyyy'
    });

});

// load datatable audit
function reload_datatable() {
    let start = $('[name="start"]'),
        end = $('[name="end"]'),
        user_id = $('[name="user_id"]'),
        action = $('[name="action"]'),

        url_datatable_audit = "/audits/datatable",
        data_list_audit = {
            start_date: start.val(),
            end_date: end.val(),
            user_id: user_id.val(),
            action: action.val(),
            "_token": $('[name="_token"]').val()
        };

    let columns = [
        {
            "data": "id", "render": function (data, type, row, meta) {
                return meta.row + 1
            }
        },
        {"data": "date"},
        {"data": "user.name"},
        {"data": "event"},
        {
            "data": "table", "render": function (data, type, row, meta) {
                let auditable_type = row['auditable_type'].replace('App', '');
                return auditable_type.substring(1, auditable_type.length);
            }
        },
        {"data": "old_values"},
        {"data": "new_values"},
    ];
    dataTableAudit = load_dtb('tableAudit', url_datatable_audit, data_list_audit, columns);
}


$(document).on('click', '#searchAudit', function () {

    dataTableAudit.destroy();
    reload_datatable();
});