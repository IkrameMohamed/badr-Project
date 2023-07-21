@extends('layout.app')

@section('title_parent') @lang('menu.appointment') @endsection
@section('title') @lang('menu.appointment') @endsection

@section('css')
    @include('globalComponents.datatableCss')
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/fixe_modal.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/dropify/dist/css/dropify.min.css')}}">
@endsection

@section('content')
    @csrf
    <h style="font-size: 40px; margin-left: 600px;">Rendez-Vous</h> <br>
    <button type="button" class="btn btn-info  mb-1 CreatAppointmentBtn" data-toggle="modal" data-target="#CreatAppointment">
        <i class="fa fa-plus"></i> @lang('appointment.create_appointment')
    </button>

    <div class="row mt-3">
    </div>
    <table id="tableAppointment" width="100%"
           class="table table-striped text-center table-bordered mb-0  no-wrap dataTable">
        <thead class="bg-primary text-white ">
        <tr>
            <th>#</th>
            <th >@lang('global.date_appointment')</th>
            <th>@lang('global.visit_type')</th>
            <th>@lang('global.doctor_name')</th>
            <th>@lang('global.user')</th>
            <th>@lang('global.checked')</th>
            <th>@lang('global.created_at')</th>
            <th class="noExport all">@lang('global.action')</th>
        </tr>
        </thead>
    </table>
    @can('add_appointments')
        @include('appointment.create')
    @endcan
    @can('delete_appointments')
        @include('globalComponents.delete_modal')
    @endcan
@endsection


@section('js')
    @include('globalComponents.datatableJs');
    @include('globalComponents.dropifyJs')
    <script >

    var permission_translation = JSON.parse(`{{readLangFle('permission' ,false)}}`.replace(/(&quot\;)/g, "\""));

    var appointmentPermission = {
        delete_appointments: @can('delete_appointments')  true @else false @endcan,
        checked_appointments: @can('checked_appointments')  true @else false @endcan,
    }
    </script>
    <script src="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/appointment/appointment.js')}} "></script>
@endsection
