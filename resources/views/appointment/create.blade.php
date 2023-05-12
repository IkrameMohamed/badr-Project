<div class="modal fade" id="CreatAppointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('user.create_user')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(array('url' => '/appointments/create', 'method' => 'post' ,'class' => 'form-horizontal',
                                'id'=>'formCreateAppointment','files'=> true ))!!}
            <div class="modal-body">


                <div class="form-group row">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.name')</label>
                    <div class="col-sm-8">
                        <input type="date" name="appointment_date" class="form-control" data-parsley-required
                               placeholder="@lang('user.enter_user_name')">
                    </div>
                </div>


                <div class="form-group row ">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.visit_type')</label>
                    <div class="col-sm-8">
                        <select class="selectpicker show-tick" data-live-search="true" name="visit_type" data-parsley-required ></select>
                    </div>
                </div>



                <div class="form-group row ">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.doctor')</label>
                    <div class="col-sm-8">
                        <select class="selectpicker show-tick" data-live-search="true" name="doctor" data-parsley-required ></select>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-sm-4 control-label col-form-label"></label>
                    <div class="col-sm-8">
                       <span class="doctor_discount"> </span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">@lang('global.close')</button>
                <button type="submit" class="btn btn-info">@lang('global.save')</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
