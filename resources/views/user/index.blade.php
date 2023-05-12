@extends('layout.app')

@section('title_parent') @lang('menu.all_users') @endsection
@section('title') @lang('user.users') @endsection

@section('css')
    @include('globalComponents.datatableCss')
    <link rel="stylesheet" href="{{asset('plugins/dropify/dist/css/dropify.min.css')}}">
@endsection
@section('content')


    @can(['add_users'])
        <button type="button" class="btn btn-info  mb-1 CreatUserBtn" data-toggle="modal" data-target="#CreatUser">
            <i class="fa fa-plus"></i> @lang('user.create_user')
        </button>
    @endcan
    @csrf

    <table id="tableUsers" width="100%"
           class="table table-striped text-center table-bordered mb-0  no-wrap dataTable">
        <thead class="bg-primary text-white ">
        <tr>
            <th>#</th>
            <th>@lang('global.name')</th>
            <th>@lang('global.email')</th>
            <th>@lang('global.created_at')</th>
            <th class="noExport all">@lang('global.action')</th>
        </tr>
        </thead>
    </table>

    @can('add_users')
        @include('user.create')
    @endcan

    @include('user.view')

    @can('update_users')
        @include('user.update')
        @include('user.updatePermission')
    @endcan
    @can('delete_users')
        @include('globalComponents.delete_modal')
    @endcan
@endsection


@section('js')
    @include('globalComponents.datatableJs');
    @include('globalComponents.dropifyJs');
    <script>
        var userPermission = {
            update_users: @can('update_users')  true @else false @endcan,
            delete_users: @can('delete_users')  true @else false @endcan,
        }
        var permission_translation = JSON.parse(`{{readLangFle('permission' ,false)}}`.replace(/(&quot\;)/g, "\""));
        var menu_translation = JSON.parse(`{{readLangFle('menu' ,false)}}`.replace(/(&quot\;)/g, "\""));

        var user_id = '{{Auth::id()}}';

    </script>
    <script src="{{asset('js/user/user.js')}} "></script>
    <script src="{{asset('js/user/permission.js')}} "></script>
@endsection
