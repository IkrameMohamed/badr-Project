<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href='image/logobadr.svg' />
    <link rel="stylesheet" href="{{asset('plugins/dropify/dist/css/dropify.min.css')}}">



    <!-- CSS Files -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/sweetAlert2/css/sweetAlert2.css')}}" rel="stylesheet">
    <link href="{{asset('css/main/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/main/switch.css')}}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link href="{{asset('adminTheme/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('adminTheme/css/sb-admin-2.min.css')}}" rel="stylesheet">



    <title>S'inscrire</title>
    <style>

        body {
            background-color: lightgray;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #7b96b3;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            width: 600px;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #fd7e14;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: black;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: white;
        }

        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            background-color: #fd7e14;
            font-size: 22px;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>S'inscrire</h1>
    {!! Form::open(array('url' => '/users/createWithoutLogin', 'method' => 'post' ,'class' => 'form-horizontal',
                                 'id'=>'formCreateUser','files'=> true ))!!}

        <div class="form-group">
            <label for="Dossier_med">Dossier Medical</label>
            <input type="file" name="UserImage" class="dropify"
                   data-height="100" placeholder="Dossier Medical ">
        </div>



        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="UserName" class="form-control" data-parsley-required
                   placeholder="@lang('user.enter_user_name')">

        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="lastName" class="form-control" data-parsley-required
                   placeholder="@lang('user.lastName')">

        </div>

    <div class="form-group">
        <label for="numeroTel">Numéro de Téléphone</label>
        <input type="text" name="phone" class="form-control" data-parsley-required
               placeholder="@lang('user.phone')">
    </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="UserEmail" class="form-control" data-parsley-required
                   placeholder="@lang('user.enter_user_email')">

        </div>


    <div class="form-group ">
        <label  for="UserPassword" >@lang('global.password')</label>
      <input type="password" name="UserPassword" class="form-control" data-parsley-required
                   id="UserPassword" placeholder="@lang('user.enter_user_password')">

    </div>

    <div class="form-group ">
        <label  for="UserCPassword">@lang('user.confirm_password')</label>

            <input type="password" name="UserCPassword" class="form-control" data-parsley-required
                   data-parsley-equalto="#UserPassword"
                   placeholder="@lang('user.confirm_user_password')">

    </div>

    <div class="form-group">
        <label for="type">type</label>

        <select class="selectpicker show-tick" style="width: 100%;" data-live-search="true" name="type" data-parsley-required >

        </select>

    </div>

    <div class="form-group">
        <label for="age">Avez-vous moins de 18 ans ?</label>

            <label><input type="radio"  name="under_age" value="1" checked >Oui</label>
            <label><input type="radio" name="under_age" value="0"  >Non</label>

    </div>

    <div class="form-group" >
        <label for="disability">Avez-vous un handicap ou besoin de garde malade?</label>
            <label><input type="radio" name="handicap" value="1"  >Oui</label>
            <label><input type="radio" name="handicap" value="0" checked>Non</label>

    </div>


    <input type="submit" value="S'inscrire">

    {!! Form::close() !!}
</div>
</body>


<script>
    var url = "{{url('/')}}";
    var asset = "{{asset('/')}}";
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

<script src="{{asset('plugins/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js')}}"></script>

<script src="{{asset('js/main/main.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('adminTheme/js/sb-admin-2.min.js')}}"></script>



<script src="{{asset('plugins/dropify/dist/js/dropify.min.js')}}"></script>
<script src="{{asset('js/main/dropify.js')}}"></script>

<script src="{{asset('js/user/user-regester.js')}} "></script>
</html>
