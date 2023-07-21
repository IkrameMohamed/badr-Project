<div class="modal fade" id="CreatUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('user.create_user')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(array('url' => '/users/create', 'method' => 'post' ,'class' => 'form-horizontal',
                                'id'=>'formCreateUser','files'=> true ))!!}
            <div class="modal-body">

                <div class="form-group mb-4">
                    <input type="file" name="UserImage" class="dropify"
                           data-height="100"
                           data-default-file="{{ asset('files/default_image/profiel.jpg') }}">
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.name')</label>
                    <div class="col-sm-8">
                        <input type="text" name="UserName" class="form-control" data-parsley-required
                               placeholder="@lang('user.enter_user_name')">
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
                    <label class="col-sm-4 control-label col-form-label">@lang('global.email')</label>
                    <div class="col-sm-8">
                        <input type="email" name="UserEmail" class="form-control" data-parsley-required
                               placeholder="@lang('user.enter_user_email')">
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.role')</label>
                    <div class="col-sm-8">
                        <select class="selectpicker show-tick" data-live-search="true" name="allRoles" data-parsley-required >
                        </select>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.type')</label>
                    <div class="col-sm-8">
                        <select class="selectpicker show-tick" data-live-search="true" name="type" data-parsley-required >

                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-4 control-label col-form-label">moins de 18 ans ?</label>
                    <div class="col-sm-8">
                        <label class="switch">
                            <input type="checkbox" name="under_age" checked/>
                            <div class="slider"></div>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 control-label col-form-label">besoin de garde malade?</label>
                    <div class="col-sm-8">
                        <label class="switch">
                            <input type="checkbox" name="handicap" />
                            <div class="slider"></div>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 control-label col-form-label">@lang('global.password')</label>
                    <div class="col-sm-8">
                        <input type="password" name="UserPassword" class="form-control" data-parsley-required
                               id="UserPassword" placeholder="@lang('user.enter_user_password')">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 control-label col-form-label">@lang('user.confirm_password')</label>
                    <div class="col-sm-8">
                        <input type="password" name="UserCPassword" class="form-control" data-parsley-required
                               data-parsley-equalto="#UserPassword"
                               placeholder="@lang('user.confirm_user_password')">
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
