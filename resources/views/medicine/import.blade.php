<div class="modal fade" id="modalImportMedicine" tabindex="-1" role="dialog" aria-labelledby="modalImportMedicine"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('medicine.import_medicine')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(array('url' =>  route('import') , 'method' => 'post' ,'class' => 'form-horizontal',
                                'id'=>'formImportMedicine','files'=> true ))!!}
            <div class="modal-body">

                <div class="form-group mb-4">
                    <input type="file" name="file" class="dropify" data-max-file-size="3M"
                           data-allowed-file-extensions="xlsx" data-height="100">
                </div>

                <input type="text" hidden name="table_name" value="medicines">
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
