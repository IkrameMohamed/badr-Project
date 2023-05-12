<div class="modal fade" id="modalCreateMedicine" tabindex="-1" role="dialog" aria-labelledby="modalCreateMedicine"
     aria-hidden="true">
    <div class="modal-dialog mw-100 w-100 " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('medicine.create_medicine')</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(array('url' => '/medicines/create', 'method' => 'post' ,'class' => 'form-horizontal',
                                'id'=>'formCreateMedicine','files'=> true ))!!}
            <div class="modal-body">
                <div class="vtabs customvtab">
                    <ul class="nav nav-tabs tabs-vertical justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#create_medicine" role="tab"
                               aria-selected="true">
                                <i class="fas fa-capsules"></i>
                                <span class="hidden-sm-down">@lang('medicine.medicine')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#create_medicine_symptoms" role="tab"
                               aria-selected="true">
                                <i class="fas fa-head-side-cough"></i>
                                <span class="hidden-sm-down">@lang('medicine.symptoms')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#create_medicine_criterias" role="tab">
                                <i class="fas fa-allergies"></i>
                                <span class="hidden-sm-down">@lang('medicine.criterias')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#create_medicine_metabolites" role="tab">
                                <i class="fas fa-virus"></i>
                                <span class="hidden-sm-down">@lang('medicine.metabolites')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#create_medicine_analytical_criterias"
                               role="tab">
                                <i class="fas fa-microscope"></i>
                                <span class="hidden-sm-down">@lang('medicine.analytical_criterias')</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content col-12">
                        <div class="tab-pane p-20 col-sm-12 active show" id="create_medicine" role="tabpanel">
                            <div class="form-group row">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 ">
                                    <input type="text" name="medicine_name" class="form-control" value=""
                                           placeholder="{{__('medicine.enter_medicine_name')}}">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane p-20 col-sm-12 " id="create_medicine_symptoms" role="tabpanel">
                            <div class="form-group row">
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-11 ">
                                    <input type="text" name="symptoms[]" class="form-control search_by_type" value=""
                                           placeholder="{{__('medicine.enter_symptom_name')}}">
                                </div>
                                <div class="col-2 col-sm-1 ">
                                    <button type="button" class="btn btn-success mb-1 create_new_input" data-type="symptoms">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane  p-20 col-sm-12" id="create_medicine_criterias" role="tabpanel">
                            <div class="form-group row">
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-11 ">
                                    <input type="text" name="criterias[]" class="form-control search_by_type" value=""
                                           placeholder="{{__('medicine.enter_criteria_name')}}">
                                </div>
                                <div class="col-2 col-sm-1 ">
                                    <button type="button" class="btn btn-success mb-1 create_new_input" data-type="criterias">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane  p-20 col-sm-12" id="create_medicine_metabolites" role="tabpanel">
                            <div class="form-group row">
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-11 ">
                                    <input type="text" name="metabolites[]" class="form-control search_by_type" value=""
                                           placeholder="{{__('medicine.enter_metabolite_name')}}">
                                </div>
                                <div class="col-2 col-sm-1 ">
                                    <button type="button" class="btn btn-success mb-1 create_new_input"  data-type="metabolites">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane  p-20 col-sm-12" id="create_medicine_analytical_criterias" role="tabpanel" >
                            <div class="form-group row">
                            </div>
                            <div class="form-group row">
                                <div class="col-10 col-sm-11 ">
                                    <input type="text" name="analytical_criterias[]" class="form-control search_by_type"
                                           value="" placeholder="{{__('medicine.enter_analytical_criteria_name')}}">
                                </div>
                                <div class="col-2 col-2 col-sm-1 ">
                                    <button type="button" class="btn btn-success mb-1 create_new_input" data-type="analytical_criterias">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
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
