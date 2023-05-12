@extends('layouts.app')

@section('title_parent') @lang('dashboard.dashboard') @endsection
@section('title') @lang('user.translation') @endsection

@section('content')
    @if(count($languages))




        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @csrf
                        <a href="{{ route('languages.create') }}" class="btn btn-info  mb-1 ">
                            <i class="fa fa-plus"></i>  {{ __('translation::translation.add') }} </a>

                    </div>

                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th>{{ __('translation::translation.language_name') }}</th>
                            <th>{{ __('translation::translation.locale') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($languages as $language => $name)
                        <tr>
                            <td>
                                {{ $name }}
                            </td>
                            <td>
                                <a href="{{ route('languages.translations.index', $language) }}">
                                    {{ $language }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    @endif





@endsection
