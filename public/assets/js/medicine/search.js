let dataTableMedicine,
    url_datatable_medicine = "/medicines/advanceSearch",
    data_list_medicine = {

    };

$(document).ready(function () {

    dataTableMedicine = $('#tableMedicine').DataTable();
    reload_datatable();

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

function update(data, keys, value) {
    if (keys.length === 0) {
        // Leaf node
        return value;
    }

    let key = keys.shift();
    if (!key) {
        data = data || [];
        if (Array.isArray(data)) {
            key = data.length;
        }
    }

    // Try converting key to a numeric value
    let index = +key;
    if (!isNaN(index)) {
        // We have a numeric index, make data a numeric array
        // This will not work if this is a associative array
        // with numeric keys
        data = data || [];
        key = index;
    }

    // If none of the above matched, we have an associative array
    data = data || {};

    let val = update(data[key], keys, value);
    data[key] = val;

    return data;
}

function getSearchDataAsJson(){
    let data = Array.from(new FormData(document.getElementById("formSearchMedicine"))) .reduce((data, [field, value]) => {
        let [_, prefix, keys] = field.match(/^([^\[]+)((?:\[[^\]]*\])*)/);

        if (keys) {
            keys = Array.from(keys.matchAll(/\[([^\]]*)\]/g), m => m[1]);
            value = update(data[prefix], keys, value);
        }
        data[prefix] = value;
        return data;
    }, {});
    return data;
}

function reload_datatable() {

let data = getSearchDataAsJson();
     dataTableMedicine.destroy();

    let columns = [
        {
            "data": "id", "render": function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {"data": "name"},
        {"data": "symptoms_count"},
        {"data": "criterias_count"},
        {"data": "metabolites_count"},
        {"data": "analytical_criterias_count"},
        {"data": "total_match"},
    ];


    dataTableMedicine = load_dtb('tableMedicine', url_datatable_medicine, data, columns);
    dataTableMedicine
        .order( [ 6, 'desc' ])
        .draw();

}


$("#formSearchMedicine").on('submit', function (e) {
    e.preventDefault();
    reload_datatable()
});
