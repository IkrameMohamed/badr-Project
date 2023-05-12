<div class="modal fade bs-example-modal-lg HideModal " id="genericDeleteModal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="myLargeModalLabel">@lang('global.delete')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => 'foo/bar', 'method' => 'delete'))!!}
                <h4>@lang('global.are_you_sure')?</h4>
                <p>@lang('global.Do_you_really_want_to_delete_these_records')  ?
                    @lang('global.this_process_cannot_be_undone')</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect text-left"
                        data-dismiss="modal">@lang('global.close')</button>

                <input type="hidden" name="id">
                <button type="submit" class="btn btn-danger waves-effect text-left">@lang('global.delete')</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
