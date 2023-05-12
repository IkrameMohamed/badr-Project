@extends('layout.app')
@section('title_parent') @lang('menu.roles') @endsection
@section('css')
    @include('globalComponents.datatableCss')
@endsection
@section('content')
                    @can(['add_roles'])
                        <button type="button" class="btn btn-info  mb-1 " data-toggle="modal"
                                data-target="#modalCreateRole">
                            <i class="fa fa-plus"></i> @lang('role.create_role') </button>
                    @endcan
                    @csrf

                        <table id="tableRoles" width="100%"
                               class="table table-striped text-center table-bordered mb-0  no-wrap dataTable">
                            <thead class="bg-primary text-white ">
                            <tr>
                                <th>#</th>
                                <th>@lang('global.name')</th>
                                <th>@lang('global.created_at')</th>
                                <th class="noExport all">@lang('global.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


    @can('add_roles')
        @include('role.create')
    @endcan
        @include('role.view')
    @can('update_roles')
        @include('role.update')
        @include('role.updatePermission')
    @endcan
    @can('delete_roles')
        @include('globalComponents.delete_modal')
    @endcan
@endsection


@section('js')
    @include('globalComponents.datatableJs');
    <script>
        var role_permission = {
            update_roles: @can('update_roles')  true @else false @endcan,
            delete_roles: @can('delete_roles')  true @else false @endcan,
        }
        var permission_translation = JSON.parse(`{{readLangFle('permission' ,false)}}`.replace(/(&quot\;)/g, "\""));
        var menu_translation = JSON.parse(`{{readLangFle('menu' ,false)}}`.replace(/(&quot\;)/g, "\""));
        var role_translation = JSON.parse(`{{readLangFle('role' ,false)}}`.replace(/(&quot\;)/g, "\""));

    </script>
    <script src="{{asset('js/role/role.js')}} "></script>
    <script src="{{asset('js/role/permission.js')}} "></script>
@endsection
