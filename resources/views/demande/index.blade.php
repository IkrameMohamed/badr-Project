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
    <h style="font-size: 40px; margin-left: 600px;">list de demande</h>
    <div class=" row">
        <table id="tableAppointment" width="100%"
               class="table table-striped text-center table-bordered mb-0  no-wrap dataTable">
            <thead class="bg-primary text-white ">
            <tr style="background-color: #4d75db  ;">
                <th>id</th>
                <th> patient</th>
                <th> produit</th>
                <th>Ordonnance</th>
            </tr>
            </thead>
            <tbody>
            @foreach($achats as $achat)
                <tr>
                    <td class="w-30"> {{$achat->id}}</td>
                    <td>{{$achat->user->name}} </td>
                    <td>{{$achat->product->nom}}</td>
                    <td style="max-width: 80px;max-height: 80px;"> <img style="max-width: 80px;max-height: 80px;" src="data:{{$achat->ordonnance}};base64,{{ base64_encode($achat->ordonnance) }}"  alt="My Image"></td>
                </tr>
            @endforeach
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
