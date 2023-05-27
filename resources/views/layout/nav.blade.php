@section('nav')
    <!-- Navbar -->
    @php(
$currentLang = lang()
)
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>



        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">



            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                    <img class="img-profile rounded-circle"
                         src="{{asset('files/default_image/profiel.jpg')}}" rel="stylesheet">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="userDropdown">

                    @foreach(['ar','en','fr'] as $lang)
                        @if($lang != $currentLang)
                            <a class="dropdown-item" href="{{url('/users/lang/'.$lang)}}">
                                @lang('header.'.$lang)
                            </a>
                        @endif
                    @endforeach


                    <div class="dropdown-divider"></div>


                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> @lang(('global.logout'))
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->
    <!-- End Navbar -->
@endsection
