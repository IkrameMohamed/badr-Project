<div id="modalUpdateRole" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalUpdateRole" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('role.update_role')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => '/roles/update', 'method' => 'post' ,'class' => 'form-horizontal','id'=>'formUpdateRole'))!!}
                <div class="modal-body">
                    <div class="form-group row">
                        {!! Form::hidden('id') !!}
                        <label class="col-sm-3 control-label col-form-label">@lang('global.name')</label>
                        <div class="col-sm-9">
                            <input type="text" name="RoleName" class="form-control" data-parsley-required
                                   placeholder="@lang('global.name')">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                    <button type="submit" class="btn btn-warning">@lang('global.update')</button>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
