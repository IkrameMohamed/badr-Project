@extends('layout.app')

@section('title_parent') @lang('menu.appointment') @endsection
@section('title') @lang('menu.appointment') @endsection

@section('css')
    @include('globalComponents.datatableCss')
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/fixe_modal.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/dropify/dist/css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{asset('extrat/css/material-dashboard.css')}}">
@endsection

@section('content')
    @csrf
<style>
    .bg-gradient-primary {
         background-image: none;
    }
</style>
    <div class=" row">
        <div class="col-sm-2" >
        </div>
    <form action="{{ route('don.store') }}" class="col-sm-8"  method="post" enctype="multipart/form-data">
        @csrf
        <h1>Ajouter Produit</h1>

        <div class="formcontainer">
            <div class="container">


                <label for=""><strong>Nom de produit</strong></label>

                <input type="text" placeholder="nom" name="nom" id="nom" required>


                <label for="category"><strong>Categorie</strong></label>
                <select  name="category" class="mb-5" style="width: 100%;height: 55px;" id="category" required  >
                    <option value="MEDICAMENT">MEDICAMENT</option>
                    <option value="CHAISE_ROULENT">CHAISE_ROULENT</option>
                    <option value="EQUIPEMENT_MEDICO">EQUIPEMENT_MEDICO</option>
                </select>


                <label for="image"><strong>L'image de produit</strong></label>
                <input type="file" placeholder="image" name="image" id="image" required>
                <br><br>
                <label for="quantite"><strong>quantité</strong></label>
                <input type="text" placeholder="Quanite" name="quantite" id="quantite" required>


            </div>
            <button type="submit" onclick="showAlert()"><strong>Ajoute</strong>
            </button>

    </form>
        <div class="col-sm-2" >
        </div>
    </div>



@endsection


@section('js')
    @include('globalComponents.datatableJs');
    @include('globalComponents.dropifyJs')

    <script src="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
    <script>
        function showAlert() {
            alert("produit est ajouté avec succes");
        }

    </script>
@endsection
