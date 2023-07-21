<!DOCTYPE html>
<html lang="en">
<head>

    <title>Se connecter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- animate CSS -->
   <link rel="stylesheet" href="css/animate.css">
   <!-- owl carousel CSS -->
   <link rel="stylesheet" href="css/owl.carousel.min.css">
   <!-- themify CSS -->
   <link rel="stylesheet" href="css/themify-icons.css">
   <!-- flaticon CSS -->
   <link rel="stylesheet" href="css/flaticon.css">
   <!-- magnific-popup CSS -->
   <link rel="stylesheet" href="css/magnific-popup.css">
   <!-- font awesome CSS -->
   <link rel="stylesheet" href="fontawesome/css/all.min.css">
   <!-- style CSS -->
   <link rel="stylesheet" href="css/style.css">
    <!--===============================================================================================-->
    <link rel="icon"  href="{{asset('images/pharmacy.ico')}}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_v18/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('Login_v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('Login_v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_v18/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_v18/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_v18/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_v18/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_v18/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_v18/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Login_v18/css/main.css')}}">
    <!--===============================================================================================-->
    <link rel="icon" href='image/logobadr.svg' />
</head>
<body style="background-color: #666666;">
<header class="main_menu home_menu">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/"> <img src="image/logobadr.svg" alt="logo"> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse main-menu-item" id="navbarNav">
                        <ul class="navbar-nav">
                            <li>
                                <a class="nav-link" href="/">Association</a>
                            </li>
                           <li>
                            <a class="nav-link" href="/event">nos événements</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact">contactez-nous</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Se connecter</a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
         </div>
      </div>
   </header>

@if (Session::has('users'))
    fggfgf
@endif
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" id="loginform" method="POST" action="{{ route('login') }}">
                @csrf
                <span class="login100-form-title p-b-43">
						Connectez Vous
					</span>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100 has-val " id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                           name="email" value="{{ old('email') }}" required autocomplete="email"
                           autofocus>
                    <span class="focus-input100"></span>
                    <span class="label-input100">Email</span>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror


                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100 has-val @error('password') is-invalid @enderror"
                           autocomplete="current-password" placeholder="{{ __('Password') }}" type="password" name="password">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Mot de passe</span>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <div class="flex-sb-m w-full p-t-3 p-b-32">

               </div>


                <div class="container-login100-form-btn">

                    <button class="login100-form-btn"
                            type="submit">{{ __('Connecter') }}</button>
                </div>
                <div class="container-login100-form-btn">

                    <button ><a href="/register">Créé compte</a></button>
                </div>


            </form>

            <div class="login100-more" style="background-image: url('image/deb2.jpg')">
            </div>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="{{asset('Login_v18/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('Login_v18/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('Login_v18/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('Login_v18/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('Login_v18/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('Login_v18/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('Login_v18/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('Login_v18/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('Login_v18/js/main.js')}}"></script>

</body>
</html>
