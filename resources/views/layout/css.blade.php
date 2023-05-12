@section('cssPlugins')

    @php(
    $lang = lang()
    )
    <!-- CSS Files -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/sweetAlert2/css/sweetAlert2.css')}}" rel="stylesheet">
    <link href="{{asset('css/main/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/main/switch.css')}}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    @if($lang =='ar')

        <link href="{{asset('adminTheme/vendor/fontawesome-free/css/all.min.rtl.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('adminTheme/css/sb-admin-2.min.rtl.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('adminTheme/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('adminTheme/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @endif

@endsection
