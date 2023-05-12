@include('layout.css')
@include('layout.footer')
@include('layout.nav')
@include('layout.script')
@include('layout.sidebar')
@php(
$lang = lang()
)
    <!DOCTYPE html>
<html @if($lang=='ar') dir="rtl" @endif lang="{{$lang}}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('images/pharmacy.ico')}}" />
    <title>@yield('title')</title>

    @yield('cssPlugins')
    @yield('css')

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

@yield('sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        @yield('nav')

        <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
    @yield('footer')
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


@yield('scriptPlugins')
@yield('js')
</body>

</html>
