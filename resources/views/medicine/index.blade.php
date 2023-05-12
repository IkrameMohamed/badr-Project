@extends('layout.app')

@section('title_parent') @lang('menu.medicine') @endsection
@section('title') @lang('medicine.medicine') @endsection

@section('css')
    @include('globalComponents.datatableCss')
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/fixe_modal.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/dropify/dist/css/dropify.min.css')}}">
@endsection
@section('content')
    @csrf
    @can(['add_medicines'])
    <button type="button" class="btn btn-info  mb-1 " data-toggle="modal" data-target="#modalCreateMedicine">
        <i class="fa fa-plus"></i> @lang('medicine.create_medicine')
    </button>
    @endcan
    @can(['import_medicines'])
    <button type="button" class="btn btn-warning  mb-1 " data-toggle="modal" data-target="#modalImportMedicine">
        <i class="fas fa-file-upload"></i> @lang('medicine.import_medicine')
    </button>
    @endcan
    @can(['export_medicines'])
    <a class="btn btn-primary" href="{{ route('export',"medicines") }}"> <i class="fas fa-file-download"></i> @lang('medicine.export_medicine_structure')</a>
    @endcan
    <div class="row mt-3">
    </div>
    <table id="tableMedicine" width="100%"
           class="table table-striped text-center table-bordered mb-0  no-wrap dataTable">
        <thead class="bg-primary text-white ">
        <tr>
            <th>#</th>
            <th>@lang('global.name')</th>
            <th class="noExport all">@lang('global.action')</th>
        </tr>
        </thead>
    </table>

    @include('medicine.view')

    @can(['add_medicines'])
        @include('medicine.create')
    @endcan
    @can(['update_medicines'])
        @include('medicine.update')
    @endcan
    @can(['import_medicines'])
        @include('medicine.import')
    @endcan
    @can(['delete_medicines'])
        @include('globalComponents.delete_modal')
    @endcan

@endsection


@section('js')
    @include('globalComponents.datatableJs');
    @include('globalComponents.dropifyJs')
    <script >
    var medicinePermission = {
        update_medicines: @can('update_medicines')  true @else false @endcan,
        delete_medicines: @can('delete_medicines')  true @else false @endcan,
    }
    var permission_translation = JSON.parse(`{{readLangFle('permission' ,false)}}`.replace(/(&quot\;)/g, "\""));

    </script>
    <script src="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/medicine/medicine.js')}} "></script>
@endsection
