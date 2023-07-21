<!DOCTYPE html>
<html lang="en">
  <head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="C:\Users\BOUMDHAL Ahlem\Desktop\pfe\firstlogo.png">
<link rel="icon" type="image/png" href="image/firstlogo.png">
<title>
   Acces admin
</title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

<link id="pagestyle"/>
  </head>
  <body class="g-sidenav-show  bg-gray-100">
        <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
      <img src="image/logobadr.svg" class="navbar-brand-img h-100" alt="main_logo">  </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
<li class="nav-item">
  <a class="nav-link text-white " href="/don">
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10">dashboard</i>
      </div>
    <span class="nav-link-text ms-1">Gestion des dons</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link text-white " href="/pro">
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10">dashboard</i>
      </div>
    <span class="nav-link-text ms-1">liste des produits</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link text-white " href="/liste">
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10">dashboard</i>
      </div>
    <span class="nav-link-text ms-1">Demandes</span>
  </a>
</li>
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
      <a  class="btn bg-gradient-primary mt-4 w-100" href="/" type="button">Retour</a>
    </div>
  </div>
</aside>
      <main class="main-content border-radius-lg ">
        <!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Association El Badr</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Page d'adminitsrareur</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Controle</h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group input-group-outline">
            <label class="form-label">Recherche...</label>
            <input type="text" class="form-control">
          </div>
      </div>
      <ul class="navbar-nav  justify-content-end">

        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
        <li class="nav-item px-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0">
            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
          </a>
        </li>
           </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
            <div class="container-fluid py-4">
<h6>Toutes les donnees sont sous la responsabilite de l'adminitsrareur.</h6>
<div class="row">
  <div class="col-lg-7 position-relative z-index-2">
    <div class="card card-plain mb-4">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-lg-6">
            <div class="d-flex flex-column h-100">
  <h2 class="font-weight-bolder mb-0">Accessibilite</h2>
</div>
          </div>
        </div>
      </div>
    </div>

          <table class="table align-items-center " border="1">
            <tbody>
              <tr style="background-color: #0B61A4;">
                <td class="w-30"> Id </td><td> Id patient </td><td> Id produit </td> <td class="align-middle text-sm">Ordonnance</td>
              </tr>
              @foreach($achats as $achat) <tr>
                <td class="w-30"> {{$achat->id}}</td>
                <td>{{$achat->user_id}} </td>
                <td>{{$achat->product_id}}</td>
                <td class="align-middle text-sm"> <a href="{{$achat->ordonnance}}" >ordonannce</a>
                </td>
              </tr>@endforeach
            </tbody>
          </table>

            </div>
     </div>
            </div>
       </main>

  </body>

</html>
