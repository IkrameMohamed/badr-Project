@section('sidebar')
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">

            <img src="{{asset('images/settings/logo-sidebar.png')}}" style=" max-width: 45px;max-height: 45px;">
            <div class="sidebar-brand-text mx-3">
                {{settings('company_name')}}
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span class="">@lang('menu.dashboard')</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            @lang('global.menu')
        </div>
        @foreach(permissionMenus() as $menu)

            <?php
            $children = '';
            $count = 0;
            ?>

            @if($menu['permissions'])

                <li class="nav-item">
                    <!-- if slug is link = don't have children  -->
                    @if($menu['slug'] == 'link')
                        @can($menu['name'])
                        <a class="nav-link" href="{{url($menu['href'])}}">
                            <i class="{{$menu['icon']}}"></i>
                            <span class="">@lang('menu.'.$menu['name'])</span></a>
                        @endcan
                    @endif

                <!-- if slug is dropdown = have children  -->

                    @if($menu['slug'] == 'dropdown')

                        @foreach($menu['children'] as $child)
                            @can($child['name'])
                                <?php
                                $children .= '<a class="collapse-item" href="' . url($child['href']) . '">' . trans("menu." . $child['name']) . '</a>';
                                $count++;
                                ?>

                            @endcan
                        @endforeach

                        @if($count > 0)
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#{{$menu['name']}}1"
                                   aria-expanded="true" aria-controls="collapseUtilities">
                                    <i class="{{$menu['icon']}}"></i>
                                    <span>@lang('menu.'.$menu['name'])</span>
                                </a>

                                <div id="{{$menu['name']}}1" class="collapse" aria-labelledby="headingUtilities"
                                     data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <?php echo $children ?>
                                    </div>
                                </div>
                        @endif
                    @endif
                </li>
        @endif
    @endforeach




        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
@endsection
