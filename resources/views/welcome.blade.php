@extends('layout.app')

@section('title_parent') @lang('dashboard.dashboard') @endsection
@section('title') @lang('dashboard.dashboard') @endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card page_content">
                <div class="card-body text-center" >
                    <img class="card-img  mw-50" src="{{asset('images/settings/dashbord.svg')}}" alt="Card image cap">
                </div>

            </div>
        </div>
    </div>

@endsection

