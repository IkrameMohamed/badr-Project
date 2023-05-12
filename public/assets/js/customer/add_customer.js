// form submit add, update and delete customer
$("#formCreateCustomer").on('submit', function (e) {

    e.preventDefault();
    form_submit(this,(data)=>{

        GetTableList('customers', function (data_relation) {


            let opt = '';
            let selectCustomer = $("select[name='customer']");
            $.each(data_relation, function () {
                if (data.DATA == this.id)
                    selected = 'selected';
                opt += `<option  value="${this.id}">${this.name}</option>`;
            });


            selectCustomer.html(opt).selectpicker('refresh');
            selectCustomer.selectpicker('val', data.DATA );
        });
        if ($(location).attr('href') == url+'/customers')
              dataTableCustomer.ajax.reload();
    }) ;
});