@extends('layout.app')

@section('title_parent') @lang('menu.reservation') @endsection
@section('title') @lang('menu.reservation') @endsection

@section('css')
    @include('globalComponents.datatableCss')
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/fixe_modal.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/dropify/dist/css/dropify.min.css')}}">
@endsection
@section('content')
    @csrf
    <h style="font-size: 40px; margin-left: 600px;">Hebergement</h> <br>
    <button type="button" class="btn btn-info  mb-1 CreatReservationBtn" data-toggle="modal" data-target="#CreatReservation">
        <i class="fa fa-plus"></i> @lang('reservation.create_reservation')
    </button>

    <div class="row mt-3">
    </div>
    <table id="tableReservation" width="100%"
           class="table table-striped text-center table-bordered mb-0  no-wrap dataTable">
        <thead class="bg-primary text-white ">
        <tr>
            <th>#</th>
            <th >@lang('global.start_date')</th>
            <th>@lang('global.end_date')</th>
            <th>@lang('global.house')</th>
            <th>@lang('global.user')</th>
            <th >@lang('global.action')</th>
        </tr>
        </thead>
    </table>

    @can('add_reservations')
        @include('reservation.create')
    @endcan
    @can('delete_reservations')
        @include('globalComponents.delete_modal')
    @endcan

@endsection


@section('js')
    @include('globalComponents.datatableJs');
    @include('globalComponents.dropifyJs')
    <script >
        var permission_translation = JSON.parse(`{{readLangFle('permission' ,false)}}`.replace(/(&quot\;)/g, "\""));
        var reservationPermission = {
            delete_reservations: @can('delete_reservations')  true @else false @endcan,
        }

    </script>
    <script src="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/reservation/reservation.js')}} "></script>
@endsection
