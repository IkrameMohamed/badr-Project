let dataTableMedicine,
    url_datatable_medicine = "/medicines/datatable",
    data_list_medicine = {
        "_token": $('[name="_token"]').val()
    };


$(document).ready(function () {
    reload_datatable();

    dataTableMedicine.on('click', 'tr .viewMedicen', function () {
        let row = $(this).parents('tr'),
            data = dataTableMedicine.row(row).data();
        sendPost('/medicines/get', {id: data.id})
            .then((response) => {
                if (response.STATUS === "SUCCESS") {
                    renderMedicineView(response.DATA);
                    $('#modalViewMedicine').modal('show');
                }
            })
            .catch((err) => console.log(err));
    });

    dataTableMedicine.on('click', 'tr .updateMedicen', function () {

        let row = $(this).parents('tr'),
            data = dataTableMedicine.row(row).data();

        $('#formUpdateMedicine').find("[name='id']").val(data.id);
        sendPost('/medicines/get', {id: data.id})
            .then((response) => {
                if (response.STATUS === "SUCCESS") {
                    renderMedicineUpdate(response.DATA);
                    $('#modalUpdateMedicine').modal('show');
                }
            })
            .catch((err) => console.log(err));
    });

    $(document).on('click', '.create_new_input', function () {
        let type = $(this).attr('data-type'),
            ele = new_input_structure(type);
        $(this).closest('.tab-pane').append(ele);
    });

    $(document).on('click', '.remove_new_input', function () {
        $(this).closest('.form-group').remove();
    });

    $(document).on('keydown.autocomplete', '.search_by_type', function () {
        let type = $(this).attr('name').replace('[]', '');
        $(this).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: url + "/" + type + "/Autocomplete",
                    type: 'post',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    },
                    data: {
                        search: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $(this).val(ui.item.label);
                return false;
            }
        });
    });
});


function new_input_structure(input_name) {
    return `    <div class="form-group row">
                                <div class="col-10 col-sm-11  ">
                                    <input type="text" name="${input_name}[]"  class="form-control search_by_type" value="" >
                                </div>
                                <div class="col-2 col-sm-1 ">
                                    <button type="button" class="btn btn-danger remove_new_input mb-1 ">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
            </div>`;
}


function renderMedicineView(data) {

    let modalViewContent = $('#modalViewMedicine .tab-content');
    modalViewContent.find("#view_medicine [name*=medicine_name]").val(data['name']);
    modalViewContent.find("#view_medicine_symptoms").html(getViewTabsContent(data['symptoms'], 'symptoms'));
    modalViewContent.find("#view_medicine_criterias").html(getViewTabsContent(data['criterias'], 'criterias'));
    modalViewContent.find("#view_medicine_metabolites").html(getViewTabsContent(data['metabolites'], 'metabolites'));
    modalViewContent.find("#view_medicine_analytical_criterias").html(getViewTabsContent(data['analytical_criterias'], 'analytical_criterias'));

}

function getViewTabsContent(data, input_name) {
    let render = '';
    render += `<div class="form-group row">
                </div>`;
    $.each(data, function (index, value) {
        render += `<div class="form-group row">
                         <div class="col-sm-10 offset-sm-1">
                              <input type="text" name="${input_name}[]" disabled class="form-control" value="${value['name']}">
                         </div>
                    </div>`;
    });
    return render;
}


function renderMedicineUpdate(data) {

    let modalUpdateContent = $('#modalUpdateMedicine .tab-content');
    modalUpdateContent.find("#update_medicine [name*=medicine_name]").val(data['name']);
    modalUpdateContent.find("#update_medicine_symptoms").html(getUpdateTabsContent(data['symptoms'], 'symptoms'));
    modalUpdateContent.find("#update_medicine_criterias").html(getUpdateTabsContent(data['criterias'], 'criterias'));
    modalUpdateContent.find("#update_medicine_metabolites").html(getUpdateTabsContent(data['metabolites'], 'metabolites'));
    modalUpdateContent.find("#update_medicine_analytical_criterias").html(getUpdateTabsContent(data['analytical_criterias'], 'analytical_criterias'));

}

function getUpdateTabsContent(data, input_name) {
    let render = '';
    render += `<div class="form-group row">
                </div>`;

    if (!$.isEmptyObject(data)) {
        $.each(data, function (index, value) {
            if (index == 0) {
                render += `<div class="form-group row">
                                <div class="col-10 col-sm-11 ">
                                    <input type="text" name="${input_name}[]"  class="form-control search_by_type" value="${value['name']}">
                                </div>
                                <div class="col-2 col-sm-1">
                                    <button type="button" class="btn btn-success mb-1 create_new_input" data-type="${input_name}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>`;
            } else {
                render += `  <div class="form-group row">
                                <div class="col-10 col-sm-11 ">
                                    <input type="text" name="${input_name}[]"  class="form-control search_by_type" value="${value['name']}" >
                                </div>
                                <div class="col-2 col-sm-1">
                                    <button type="button" class="btn btn-danger remove_new_input mb-1 ">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>`;
            }

        });
    } else {
        render += `<div class="form-group row">
                                <div class="col-10 col-sm-11 ">
                                    <input type="text" name="${input_name}[]"  class="form-control search_by_type" value="">
                                </div>
                                <div class="col-2 col-sm-1">
                                    <button type="button" class="btn btn-success mb-1 create_new_input" data-type="${input_name}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>`;
    }
    return render;
}

function reload_datatable() {

    let columns = [
        {
            "data": "id", "render": function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {"data": "name"},
        {
            "data": "name", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                let list = `<div class="dropdown">
                                     <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         ${translate["action"]}
                                    </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">`;

                    list += `<button class="dropdown-item viewMedicen" type="button"> <i class='fa fa-eye text-primary'></i> ${translate["view"]}</button>`;
                if (medicinePermission['update_medicines'])
                    list += `<button class="dropdown-item updateMedicen" type="button"> <i class='fa fa-edit text-warning'></i> ${translate["update"]}</button>`;
                if (medicinePermission['delete_medicines'])
                    list += `<button class="dropdown-item genericDeleteModalBtn"  type="button" data-id='${row["id"]}' data-action='/medicines/delete'>
                                     <i class='fa fa-trash text-danger'></i> ${translate["delete"]}</button>`;

                list += `</div>
                     </div>`;
                return list;
            }
        }
    ];
    dataTableMedicine = load_dtb('tableMedicine', url_datatable_medicine, data_list_medicine, columns);

}

$("#formCreateMedicine").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableMedicine.ajax.reload();
    });
});

$("#formUpdateMedicine").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableMedicine.ajax.reload();
    });
});

$("#formImportMedicine").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableMedicine.ajax.reload();
    });
});


$("#genericDeleteModal form").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableMedicine.ajax.reload();
    });
});
