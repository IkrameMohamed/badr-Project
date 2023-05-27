<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="icon" href="{{asset('assets/images/logobadr.svg')}}">
    <!-- Bootstrap CSS -->

    <style type="text/css">
        body {

            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;

        }

        .slider {
            width: 100%;
            height: 400px;
            overflow: hidden;
        }
        .slider figure {
            position: relative;
            width: 400%;
            left: 0;
            margin: 0;
            animation: 10s slider infinite;
        }
        .slider figure img{
            width: 25%;
            float: left;
        }

        @keyframes slider {
            0% {
                left: 0;
            }
            20% {
                left: 0;
            }
            25% {
                left: -100%;
            }
            45% {
                left: -100%;
            }
            50% {
                left: -200%;
            }
            70% {
                left: -200%;
            }
            75% {
                left: -300%;
            }
            95% {
                left: -300%;
            }
            100%{
                left: -400%;
            }


        }



        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);

            height: 500px;

            display: flex;

        }

        .card1:hover {
            padding: 10px;
        }
        .card2:hover{
            padding: 10px;
        }
        .card3:hover{
            padding: 10px;
        }

        .card1 , .card2 , .card3 {

            width: 25%;
            height: 380px;
            margin: 20px auto;
            box-shadow: 5px 10px 18px #888888;
            transition: 1 s;

            border-style: groove;
            text-align: center;
            background-color: #F5B041; ;
            color: white;
        }

        .img{
            height: 300px;
            border-radius: 5px 5px 0 0;
            position: relative;

        }
        .title{
            text-align: center;
            color: #F5B041;
        }


        .row{
            display: flex;

            width: 100%;
            height: 400px;
            background-color:  #B2D2A4 ;
            font-family: sans-serif;
            color: white;

        }
        .part1 , .part2 , .part3{
            width: 25%;
            margin: 100px auto 10px auto;
            padding: 20px;
        }
        .logo{
            margin: 30px 100px;
        }
        .part1 h4 , .part2 h4 , .part3 h4 {
            color: #E55B13;
            font-size: 22px;

        }
        ul li {
            margin: 10px;

        }
        ul li a {
            color: white;
            text-decoration: none;
        }
        ul li a:hover{
            color:#F5B041 ;
        }
        .dropdown-item{
            color: gray;
            font-size: 25px;
            text-decoration: none;


        }
    </style>
</head>
<body>

<div class="slider">

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Se Déconnecter') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <figure>

        <img src={{asset('assets/images/p2.jpg')}}>
        <img src={{asset('assets/images/p.jpg')}}>
        <img src={{asset('assets/images/pic7.jpg')}}>
        <img src={{asset('assets/images/p2.jpg')}}>
    </figure>
</div>

<div class="container">
    <h2 class="title"> Choisir Une Operation</h2>



    <div class="card">
        <div class="card1">
            <a href={{url('product')}}>
                <img class="img" src={{asset('assets/images/p2.jpg')}}  style="width:100%">
            </a>
            <div class="nom">
                <h4><b>Des dons </b></h4>
            </div>
        </div>
        <div class="card2">
            <a href={{url('heberg')}}>
                <img class="img" src={{asset('assets/images/pic7.jpg')}} style="width:100%">
            </a>
            <div class="nom">
                <h4><b>Hébargement</b></h4>
            </div>
        </div>
        <div class="card3">
            <a href={{url('rnv')}}>
                <img class="img" src={{asset('assets/images/rnv3.jpg')}}  style="width:100%">
            </a>
            <div class="nom">
                <h4><b>Rendez-Vous</b></h4>

            </div>

        </div>
    </div>

    <footer class="footer_part">
        <div class="row">
            <div class="logo">
                <a href="index.html" class="footer_logo_iner"> <img src={{asset('assets/images/logobadr.svg')}} alt="#"> </a>
            </div>



            <div class="part1">
                <h4>Nos maisons</h4>
                <ul class="list-unstyled" >
                    <li>Dar El-Ihcen01 Blida</li>
                    <li>Dar El-Ihcen02 Blida</li>
                    <li>Dar El-badr Alger</li>
                </ul>
            </div>


            <div class="part2">
                <h4> Contacter nous</h4>
                <p> <img src={{asset('assets/images/mail.svg')}} height="25px" width="25px" alt=""> association.elbadr@gmail.com</p>
                <p> <img src={{asset('assets/images/contact.svg')}} height="25px" width="25px" alt=""> +213 25 30 06 18 <br>
                    <img src={{asset('assets/images/contact.svg')}}  height="25px" width="25px" alt=""> +213 561 73 37 26</p>
                <p> <img src={{asset('assets/images/localisation.svg')}}  height="25px" width="25px" alt=""> Rue Javal, Blida– Algerie</p>
            </div>





            <div class="part3">
                <h4>Nos Réseaux</h4>
                <ul class="list-unstyled">
                    <li><img src={{asset('assets/images/facebook.svg')}} height="20px" width="20px" alt=""> <a href="https://www.facebook.com/AssociationElBadr/">Association El-Badr </a></li>
                    <li><img src={{asset('assets/images/instagram.svg')}} height="25px" width="20px" alt=""> <a href="https://www.instagram.com/association.el.badr/?hl=fr">association.el.badr</a></li>
                    <li> <img src={{asset('assets/images/linkedin.svg')}}height="20px" width="20px" alt=""> <a href="https://dz.linkedin.com/company/association-el-badr">Association El-badr</a></li>

                </ul>
            </div>

        </div>



    </footer>


</div>
</body>
</html>
