let dataTableAppointment,
    url_datatable_appointment = "/appointments/datatable",
    data_list_appointments  = {
        "_token": $('[name="_token"]').val()
    },
    visitTypesDoctors,globalDoctors=[];

$(document).ready(function () {
    reload_datatable();

    $("#formCreateAppointment [name='visit_type']").on('change', function() {
        getDoctorsByVisitType($("#formCreateAppointment"),$(this).find(":selected").val() );
    });


    $("#formCreateAppointment [name='appointment_date']").on('change', function() {
        dateValidation($("#formCreateAppointment"));
    });

    $("#formCreateAppointment [name='doctor']").on('change', function() {
        updateDiscountDoctorNameById($(this).find(":selected").val() );

    });
});

$(".CreatAppointmentBtn").on('click', function () {
    $("#formCreateAppointment")[0].reset();
    getVisitTypesDoctors($("#formCreateAppointment"));
});


function reload_datatable() {

    let columns = [
        {
            "data": "id", "render": function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {"data": "appointment_date"},
        {
            "data": "appointment_date", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                return row['visit_type']['name'];
            }
        },
        {
            "data": "appointment_date", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                return row['doctor']['name'];
            }
        },
        {
            "data": "appointment_date", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                return row['user']['name'];
            }
        },

        {
            "data": "appointment_date", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                if(row['checked'] == 1)

                return ` <div class="form-group"><label className="switch"> <input type="checkbox" checked disabled/> <div className="slider"></div></label></div>` ;
                return ` <div class="form-group"><label className="switch"> <input type="checkbox" disabled/> <div className="slider"></div></label></div>` ;
            }
        },
        {"data": "created_at"},
        {
            "data": "appointment_date", "orderable": false, "searchable": false,
            "render": function (data, type, row) {
                let list = `    <div class="dropdown">
                                     <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         ${translate["action"]}
                                    </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">`;
                if (appointmentPermission['delete_appointments'])
                    list += `<button class="dropdown-item genericDeleteModalBtn"  type="button" data-id='${row["id"]}' data-action='/appointments/delete'>
                                     <i class='fa fa-trash text-danger'></i> ${translate["delete"]}</button>`;
                if(row["checked"] != 1  && appointmentPermission['checked_appointments'])
                list += ` <button class="dropdown-item genericDatatBtn" data-action="/appointments/checkedAppointment"  data-id="${row['id']}"   type="button"> <i class="fas fa-sync-alt"></i> ${translate["checked_visit"]}</button>`;
                list += `</div>
                                </div>`;
                return list;
            }
        }
    ];
    dataTableAppointment = load_dtb('tableAppointment', url_datatable_appointment, data_list_appointments, columns);
}

function getVisitTypesDoctors(selector, field_selected = false) {
    let route = '/visit_types/doctors';
    sendPost(route, {}).then((response) => {
        if (response.STATUS === "SUCCESS") {
            visitTypesDoctors = response.DATA;
            let data = response.DATA, opt = '', lastField;
            $.each(data, function (index, role) {
                opt += `<option  value="${role['id']}">${role['name']}</option>`;
                lastField = role['id'];
            });
            selector.find("[name='visit_type']").html(opt).selectpicker('refresh');
            let selected = (field_selected) ? field_selected : lastField ;
            selector.find("[name='visit_type']").selectpicker('val', selected);
            getDoctorsByVisitType($("#formCreateAppointment"),selected);
        }
    }).catch((err) => console.log(err));
}
function getDoctorsByVisitType(selector ,visitTypeId, field_selected = false) {

    let doctors =[];
    $.each(visitTypesDoctors, function (index, visit) {
      if(visit.id == visitTypeId){
          $.each(visit.doctors, function (index, doctor) {
              if(doctor.number_days_available > 0)
                    doctors.push(doctor)
          });
      }
    });

    globalDoctors = doctors;

    let opt = '', lastField;
    $.each(doctors, function (index, doctor) {
        opt += `<option  value="${doctor['id']}">${doctor['name']}</option>`;
        lastField = doctor['id'];
    });
    selector.find("[name='doctor']").html(opt).selectpicker('refresh');
    let selected = (field_selected) ? field_selected : lastField ;

       this.updateDiscountDoctorNameById(selected);



    selector.find("[name='doctor']").selectpicker('val', selected);

}

function updateDiscountDoctorNameById(id){
if(globalDoctors.length == 0 )
    $(".doctor_discount").text( "");

    $.each(globalDoctors, function (index, doctor) {
        console.log(globalDoctors,id)
        if(doctor['id'] == id)
            $(".doctor_discount").text( "Promotion " + doctor['discount']  + " %");
    });
}

$("#genericDeleteModal form").on('submit', function (e) {
    e.preventDefault();
    form_submit(this, () => {
        dataTableAppointment.ajax.reload();
    });
});


function dateValidation(selector) {

    var UserDate =  selector.find("[name='appointment_date']").val();

    var ToDate = new Date();

    ToDate.setDate(ToDate.getDate() - 1);

    var afterWeek = new Date();

    afterWeek.setDate(afterWeek.getDate() + 7);

    if (UserDate == undefined  ) {
        showNotification('error', "The Date must be selected");
        return false;
    }

    if (new Date(UserDate).getTime() <= ToDate.getTime() ) {
        showNotification('error', "The Date must be Bigger or Equal to today date");
        return false;
    }

    if (new Date(UserDate).getTime() > afterWeek.getTime()) {
        showNotification('error', "The Date must be lower then " + afterWeek);
        return false;
    }
    return true;
}


$("#formCreateAppointment").on('submit', function (e) {
    e.preventDefault();
    let validation = dateValidation($("#formCreateAppointment"));
    if(validation)
    form_submit(this, () => {
        dataTableAppointment.ajax.reload();
    });
});
