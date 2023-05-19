<div class="modal fade" id="CreatReservation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('user.create_user')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(array('url' => '/reservations/create', 'method' => 'post' ,'class' => 'form-horizontal',
                                'id'=>'formCreateReservation','files'=> true ))!!}
            <div class="modal-body">


                <div class="form-group row">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.start_date')</label>
                    <div class="col-sm-8">
                        <input type="date" name="start_date" class="form-control" data-parsley-required
                               placeholder="@lang('global.start_date')">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.end_date')</label>
                    <div class="col-sm-8">
                        <input type="date" name="end_date" class="form-control" data-parsley-required
                               placeholder="@lang('global.end_date')">
                    </div>
                </div>


                <div class="form-group row ">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.house')</label>
                    <div class="col-sm-8">
                        <select class="selectpicker show-tick" data-live-search="true" name="house" data-parsley-required ></select>
                    </div>
                </div>


                    <div class="form-group row max_beds_by_house" style="display: none">
                        <label class="col-sm-4 control-label col-form-label"> </label>
                        <div class="col-sm-8">
                            <span class="max_beds"> ddd</span>
                        </div>
                    </div>


                <div class="form-group row beds_numbers" style="display: none" >
                        <label class="col-sm-4 control-label col-form-label">@lang('global.numbers_of_beds')</label>
                        <div class="col-sm-8">
                            <input type="text" name="beds_number" class="form-control" data-parsley-required
                                   placeholder="@lang('user.numbers_of_beds')">
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
