<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Les Medicament </title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href={{asset('extrat/css/bootstrap.min.css')}}>
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href={{asset('extrat/css/style.css')}}>
    <!-- Responsive-->
    <link rel="stylesheet" href={{asset('extrat/css/responsive.css')}}>
    <!-- fevicon -->
    <link rel="icon" href={{asset('extrat/images/fevicon.png')}} type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href={{asset('extrat/css/jquery.mCustomScrollbar.min.css')}}>
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href={{asset('extrat/css/owl.carousel.min.css')}}>
    <link rel="stylesoeet" href={{asset('/extrat/css/owl.theme.default.min.css')}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body>

<!-- banner bg main start -->
<div class="banner_bg_main">
    <!-- header top section start -->
    <div class="container">
        <div class="header_section_top">
            <div class="row">
                <div class="col-sm-12">

                </div>
            </div>
        </div>
    </div>
    <!-- header top section start -->
    <!-- logo section start -->
    <div class="logo_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="logo"><a href={{url('product')}}></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- logo section end -->
    <!-- header section start -->
    <div class="header_section">
        <div class="container">
            <div class="containt_main">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href={{url('product')}}>Accueil</a>
                    <a href={{url('med')}}>Les Médicament</a>
                    <a href={{url('chaise')}}>les chaises roulantes</a>
                    <a href={{url('equipement')}}>Les Equipements Médicaux</a>
                </div>
                <span class="toggle_icon" onclick="openNav()"><img src={{asset('extrat/images/toggle-icon.png')}}></span>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Categories
                    </button>

                </div>
                <div class="main">
                    <!-- Another variation with a button -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Rechercher">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button" style="background-color: #f26522; border-color:#f26522 ">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="header_box">

                    <div class="login_menu">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header section end -->
    <!-- banner section start -->
    <div class="banner_section layout_padding">
        <div class="container">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="banner_taital">Choisissez <br>ce dont vous avez besoin</h1>

                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="banner_taital">Choisissez <br>ce dont vous avez besoin</h1>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- banner section end -->
</div>
<!-- banner bg main end -->
<!-- fashion section start -->



<div class="fashion_section">
        <div class="carousel-inner">

            @php
                $newProductsList = array_filter($products->toArray(), function($item) {
                   return  $item['category'] == 'MEDICAMENT';
                });

                  $iteration = 0 ;
            @endphp
            @foreach (array_chunk($newProductsList, 9) as $productListOfThree)
                <div class="carousel-item {{ $iteration == 0 ? 'active' : '' }}">
                    <div class="container">
                        <h1 class="fashion_taital" style=" color: #fd7e14;">Les Médicament </h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                @foreach ($productListOfThree as $item)
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="box_main">
                                            <h4 class="shirt_text">{{$item["nom"]}}</h4>

                                            <div class="electronic_img"><img src="data:{{$item["image"]}};base64,{{ base64_encode($item["image"]) }}" alt="My Image"></div>
                                            <div class="btn_main">
                                                <div class="buy_bt" onclick="openPopup({{$item["id"]}})"><a href="#">Prenez-le</a></div>
                                                <div class="seemore_bt"><a href="#"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $iteration = 1 ;
                @endphp
            @endforeach
        </div>
    </div>





<!-- fashion section end -->
<!-- footer section start -->
<div class="footer_section layout_padding">
    <div class="container">

        <div class="location_main"><h2 style="font-size: 22px; color:#fd7e14;">Contacter Nous : </h2></div>
    </div>
</div>
<!-- footer section end -->
<!-- copyright section start -->
<div class="copyright_section">
    <div class="container">
        <div class="copyright_text">
            <p> <img src={{asset('extrat/images/mail.svg')}} height="25px" width="25px" alt=""> association.elbadr@gmail.com</p>
            <p> <img src={{asset('extrat/images/contact.svg')}} height="25px" width="25px" alt=""> +213 25 30 06 18 <br>
                <img src={{asset('extrat/images/contact.svg')}}  height="25px" width="25px" alt=""> +213 561 73 37 26</p>
            <p> <img src={{asset('extrat/images/localisation.svg')}}  height="25px" width="25px" alt=""> Rue Javal, Blida– Algerie</p>
        </div>


    </div>
</div>
<!-- copyright section end -->
<!-- Javascript files-->
<script src={{asset('extrat/js/jquery.min.js')}}></script>
<script src={{asset('extrat/js/popper.min.js')}}></script>
<script src={{asset('extrat/js/bootstrap.bundle.min.js')}}></script>
<script src={{asset('extrat/js/jquery-3.0.0.min.js')}}></script>
<script src={{asset('extrat/js/plugin.js')}}></script>
<!-- sidebar -->
<script src={{asset('extrat/js/jquery.mCustomScrollbar.concat.min.js')}}></script>
<script src={{asset('extrat/js/custom.js')}}></script>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    function openPopup(id) {
        var w = 600;
        var h = 500;
        var left = (screen.width / 2) - (w / 2);
        var top = 100;
        console.log("id",id)
        window.open('popup/'+id, 'Popup', 'width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>
</body>
</html>

