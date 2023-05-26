<div id="modalViewUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewUser"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('user.view_user')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => '', 'method' => 'post' ,'class' => 'form-horizontal','id'=>'formViewUser'))!!}
                <div class="modal-body">
                    {!! Form::hidden('id') !!}


                    <div class="form-group row">
                        <label class="col-sm-3 control-label col-form-label">@lang('global.name')</label>
                        <div class="col-sm-9">
                            <input type="text" name="UserName" class="form-control" data-parsley-required
                                   placeholder="@lang('user.enter_user_name')" disabled>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 control-label col-form-label">@lang('global.last_name')</label>
                        <div class="col-sm-8">
                            <input type="text" name="lastName" class="form-control" data-parsley-required
                                   placeholder="@lang('user.lastName')">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 control-label col-form-label">@lang('global.phone')</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone" class="form-control" data-parsley-required
                                   placeholder="@lang('user.phone')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label col-form-label">@lang('global.email')</label>
                        <div class="col-sm-9">
                            <input type="email" name="UserEmail" class="form-control" data-parsley-required
                                   placeholder="@lang('user.enter_user_email')" disabled>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-sm-3 control-label col-form-label">@lang('global.table')</label>
                        <div class="col-sm-9">
                            <select class="selectpicker show-tick" name="allRoles" data-parsley-required
                                    disabled></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label col-form-label">@lang('global.status')</label>
                        <div class="col-sm-9">
                            <label class="switch">
                                <input type="checkbox" name="UserActive" checked disabled/>
                                <div class="slider"></div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-sm-4 control-label col-form-label">@lang('global.type')</label>
                        <div class="col-sm-8">
                            <select class="selectpicker show-tick" data-live-search="true" name="type" data-parsley-required >

                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-4 dropUserImage">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
