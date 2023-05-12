<div id="modalViewRole" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewRole" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('role.view_roles')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => '', 'method' => 'post' ,'class' => 'form-horizontal','id'=>'formViewRole'))!!}
                <div class="modal-body">
                    <div class="form-group row">
                        {!! Form::hidden('id') !!}


                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label col-form-label">@lang('global.name')</label>
                        <div class="col-sm-9">
                            <input type="text" name="RoleName" class="form-control" data-parsley-required
                                   placeholder="@lang('role.enter_role_name')" disabled>
                        </div>
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
