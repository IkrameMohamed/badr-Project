<div id="modalViewMedicine" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalViewMedicine"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog mw-100 w-100">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title">@lang('medicine.view_medicine')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="vtabs customvtab">
                    <ul class="nav nav-tabs tabs-vertical justify-content-center" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#view_medicine" role="tab"
                               aria-selected="true">
                                <i class="fas fa-capsules"></i>
                                <span class="hidden-sm-down">@lang('medicine.medicine')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#view_medicine_symptoms" role="tab"
                               aria-selected="true">
                                <i class="fas fa-head-side-cough"></i>
                                <span class="hidden-sm-down">@lang('medicine.symptoms')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#view_medicine_criterias" role="tab">
                                <i class="fas fa-allergies"></i>
                                <span class="hidden-sm-down">@lang('medicine.criterias')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#view_medicine_metabolites" role="tab">
                                <i class="fas fa-virus"></i>
                                <span class="hidden-sm-down">@lang('medicine.metabolites')</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#view_medicine_analytical_criterias" role="tab">
                                <i class="fas fa-microscope"></i>
                                <span class="hidden-sm-down">@lang('medicine.analytical_criterias')</span>
                            </a>
                        </li>
                    </ul>


                    <!-- Tab panes -->

                    <div class="tab-content col-12">

                        <div class="tab-pane p-20 col-sm-12 active show" id="view_medicine" role="tabpanel">
                            <div class="form-group row">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-1">
                                    <input type="text" name="medicine_name" disabled class="form-control" value="" >
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane p-20 col-sm-12 " id="view_medicine_symptoms" role="tabpanel">
                            1
                        </div>
                        <div class="tab-pane  p-20 col-sm-12" id="view_medicine_criterias" role="tabpanel">
                            2
                        </div>
                        <div class="tab-pane  p-20 col-sm-12" id="view_medicine_metabolites" role="tabpanel">
                            3
                        </div>
                        <div class="tab-pane  p-20 col-sm-12" id="view_medicine_analytical_criterias" role="tabpanel">
                            4
                        </div>
                    </div>


                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
            </div>
        </div>

    </div>
</div>
