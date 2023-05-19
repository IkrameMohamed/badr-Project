let dataTableReservation,
    url_datatable_reservation = "/reservations/datatable",
    data_list_reservations  = {
        "_token": $('[name="_token"]').val()
    },
    beds_size = 0 ;


$(document).ready(function () {
    reload_datatable();

    $("#formCreateReservation [name='start_date']").on('change', function() {
        dateValidation($("#formCreateReservation"));
    });

    $("#formCreateReservation [name='end_date']").on('change', function() {
        dateValidation($("#formCreateReservation"));
    });

    $("#formCreateReservation [name='house']").on('change', function() {
        dateValidation($("#formCreateReservation"));
    });


});


function dateValidation(selector,refreshBedsNumber = true) {

    var start_date =  selector.find("[name='start_date']").val();

    var end_date =  selector.find("[name='end_date']").val();

    var house = selector.find("[name='house']").find(":selected").val();

    if(start_date == '' || start_date == ' ' || start_date == undefined || end_date == '' || end_date == ' ' || end_date == undefined){
        selector.find(".max_beds_by_house").css("display","none");
        selector.find(".beds_numbers").css("display","none");
        return false;
    }
    if(start_date > end_date){
        selector.find(".max_beds_by_house").css("display","none");
        selector.find(".beds_numbers").css("display","none");
        showNotification('error', "La date de fin doit être superieur a la date de debut");
        return false;
    }

        if(refreshBedsNumber){
            let data = {
                start_date: start_date,
                end_date: end_date,
                house: house
            };
            getNumberOfBedsByHouse(selector,data);
        }
        return true;
}

function reload_datatable() {

    let columns = [
        {
            "data": "id", "render": function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {"data": "start_date"},
        {"data": "end_date"},
        {"data": "house_name"},
        {"data": "user_name"},
        {
            "data": "id", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                let list = `    <div class="dropdown">
                                     <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         ${translate["action"]}
                                    </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">`;

                    list += `<button class="dropdown-item genericDeleteModalBtn"  type="button" data-id='${row["id"]}' data-action='/reservations/delete'>
                                     <i class='fa fa-trash text-danger'></i> ${translate["delete"]}</button>`;
                 list += `</div>
                                </div>`;
                return list;
            }
        }
    ];
    dataTableReservation = load_dtb('tableReservation', url_datatable_reservation, data_list_reservations, columns);
}

$("#genericDeleteModal form").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        resetForm();
        dataTableReservation.ajax.reload();
    });
});
$("#formCreateReservation").on('submit', function (e) {
    e.preventDefault();
    let validation = dataValidation($("#formCreateReservation"));
    if(validation)
        form_submit(this, () => {
            resetForm();
            dataTableReservation.ajax.reload();
        });
});

function resetForm() {
    $("#formCreateReservation")[0].reset();
    $("#formCreateReservation").find(".max_beds_by_house").css("display","none");
    $("#formCreateReservation").find(".beds_numbers").css("display","none");
}

function dataValidation(selector){
    dateValidation(selector,false);
    if (dateValidation(selector,false) == false)
        return false ;

    let beds_number = selector.find("[name='beds_number']").val();
    if (beds_number > 2){
        showNotification('error', "Le nombre de lit doit etre inferieur ou egal a 2");
        return false ;
    }

    if (beds_number > beds_size){
        showNotification('error', "Le nombre de lit dans ce maison et insuffisant ");
        return false ;
    }
    return true;

}

$(".CreatReservationBtn").on('click', function () {
    resetForm();
    getHouses($("#formCreateReservation"));
});

function getHouses(selector, field_selected = false) {
    let route = '/houses';
    sendPost(route, {}).then((response) => {
        if (response.STATUS === "SUCCESS") {
            houses = response.DATA;
            let data = response.DATA, opt = '', lastField;
            $.each(data, function (index, house) {
                opt += `<option  value="${house['id']}">${house['name']}</option>`;
                lastField = house['id'];
            });
            selector.find("[name='house']").html(opt).selectpicker('refresh');
            let selected = (field_selected) ? field_selected : lastField ;
            selector.find("[name='house']").selectpicker('val', selected);
        }
    }).catch((err) => console.log(err));
}

function getNumberOfBedsByHouse(selector,data){
    let route = '/beds/beds_available';
    sendPost(route, data).then((response) => {
        if (response.STATUS === "SUCCESS") {
            beds = response.DATA;
            beds_size = beds.length;
            selector.find(".max_beds_by_house").css("display","");
            selector.find(".max_beds").text(" nombre de lits disponibles : " +  beds_size);

            if(beds_size == 0)
                selector.find(".beds_numbers").css("display","none");
            else{
                selector.find(".beds_numbers").css("display","");
            }
        }
    }).catch((err) => console.log(err));
}
