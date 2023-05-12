@section('scriptPlugins')
    @php(
     $lang = lang()
    )
    <script>
        var url = "{{url('/')}}";
        var asset = "{{asset('/')}}";
        var theLanguage = "{{$lang}}";
    </script>

    <!--   Core JS Files   -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('plugins/bootstrap/js/popper.min.js')}}"></script>

    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('js/paper-dashbord/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('plugins/parsleyjs/js/parsley.min.js')}}"></script>


    <script src="{{asset('js/paper-dashbord/plugins/bootstrap-notify.js')}}"></script>

    <script src="{{asset('plugins/sweetAlert2/js/sweetAlert2.min.js')}}"></script>
    <!--parslay JavaScript -->
    <script src="{{asset('plugins/parsleyjs/js/parsley.min.js')}}"></script>
    <script src="{{asset('plugins/parsleyjs/i18n/' . $lang .'.js')}}"></script>

    <script src="{{asset('plugins/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select-1.13.14/dist/js/i18n/defaults-' . $lang .'_'. strtoupper( $lang ).'.js')}}"></script>

    <script src="{{asset('js/main/main.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('adminTheme/js/sb-admin-2.min.js')}}"></script>

@endsection
