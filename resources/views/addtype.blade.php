@extends('layout.app')

@section('title_parent')
    @lang('menu.appointment')
@endsection
@section('title')
    @lang('menu.appointment')
@endsection

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

        <form action="{{ route('addtype.store') }}" method="post" style="width: 80%; ">
            @csrf

            <h1>Ajouter un type</h1>


            <div class="formcontainer">
                <div class="container">


                    <label for=""><strong>type</strong></label>

                    <input type="text" placeholder="type" name="name" id="name" required>

                </div>
                <button type="submit" onclick="showAlert()"><strong>Ajoute</strong></button>
            </div>

        </form>

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
