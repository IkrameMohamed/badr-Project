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
    <h style="font-size: 40px; margin-left: 600px;">list de Produit</h>
    <div class=" row">
        <table id="tableAppointment" width="100%"
               class="table table-striped text-center table-bordered mb-0  no-wrap dataTable">
            <thead class="bg-primary text-white ">
            <tr style="background-color: #4d75db  ;">
                <td class="w-30"> id </td><td> nom de produit </td><td> categorie </td> <td>quantite</td><td class="align-middle text-sm" colspan="2" > Action</td>

            </tr>
            </thead>
            <tbody>
            @foreach($products as $product) <tr>
                <td class="w-30"> {{$product->id}}</td>
                <td> {{$product->nom}}</td>
                <td>{{$product->category}} </td>
                <td>{{$product->quantite}}</td>
                <td>   <a href="{{url('edit/'.$product->id)}}">modifier</a></td>
                <td class="align-middle text-sm">
                    <a href="{{url('delete/'.$product->id)}}">supprimer</a>
                </td>
            </tr>@endforeach
            </tbody>
        </table>
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
