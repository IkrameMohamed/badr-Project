@extends('layout.app')

@section('title_parent') @lang('menu.search') @endsection
@section('title') @lang('medicine.search') @endsection

@section('css')
    @include('globalComponents.datatableCss')
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/fixe_modal.css')}}">
@endsection
@section('content')
    @csrf
    {!! Form::open(array('url' => '/medicines/advanceSearch', 'method' => 'post' ,'class' => 'form-horizontal',
                    'id'=>'formSearchMedicine','files'=> true ))!!}

    <div class="vtabs customvtab">
        <ul class="nav nav-tabs tabs-vertical justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#search_medicine_symptoms" role="tab"
                   aria-selected="true">
                    <i class="fas fa-head-side-cough"></i>
                    <span class="hidden-sm-down">@lang('medicine.symptoms')</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#search_medicine_criterias" role="tab">
                    <i class="fas fa-allergies"></i>
                    <span class="hidden-sm-down">@lang('medicine.criterias')</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#search_medicine_metabolites" role="tab">
                    <i class="fas fa-virus"></i>
                    <span class="hidden-sm-down">@lang('medicine.metabolites')</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#search_medicine_analytical_criterias"
                   role="tab">
                    <i class="fas fa-microscope"></i>
                    <span class="hidden-sm-down">@lang('medicine.analytical_criterias')</span>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content col-12">
            <div class="tab-pane p-20 col-sm-12 active show" id="search_medicine_symptoms" role="tabpanel">
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
            <div class="tab-pane  p-20 col-sm-12" id="search_medicine_criterias" role="tabpanel">
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
            <div class="tab-pane  p-20 col-sm-12" id="search_medicine_metabolites" role="tabpanel">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                    <div class="col-10 col-sm-11 ">
                        <input type="text" name="metabolites[]" class="form-control search_by_type" value=""
                               placeholder="{{__('medicine.enter_metabolite_name')}}">
                    </div>
                    <div class="col-2 col-sm-1 ">
                        <button type="button" class="btn btn-success mb-1 create_new_input" data-type="metabolites">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="tab-pane  p-20 col-sm-12" id="search_medicine_analytical_criterias" role="tabpanel">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                    <div class="col-10 col-sm-11 ">
                        <input type="text" name="analytical_criterias[]" class="form-control search_by_type"
                               value="" placeholder="{{__('medicine.enter_analytical_criteria_name')}}">
                    </div>
                    <div class="col-2 col-2 col-sm-1 ">
                        <button type="button" class="btn btn-success mb-1 create_new_input"
                                data-type="analytical_criterias">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" text-center ">
        <button type="submit" class="btn btn-warning">@lang('global.search')</button>
    </div>
   {!! Form::close() !!}


    <table id="tableMedicine" width="100%"
           class="table table-striped text-center table-bordered mb-0  no-wrap dataTable">
        <thead class="bg-primary text-white ">
        <tr>
            <th>#</th>
            <th>@lang('medicine.name')</th>
            <th>@lang('medicine.symptoms_count')</th>
            <th>@lang('medicine.criterias_count')</th>
            <th>@lang('medicine.metabolites_count')</th>
            <th>@lang('medicine.analytical_criterias_count')</th>
            <th>@lang('medicine.total_match')</th>
        </tr>
        </thead>
    </table>



@endsection



@section('js')
    @include('globalComponents.datatableJs');

    <script src="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/medicine/search.js')}} "></script>
@endsection
