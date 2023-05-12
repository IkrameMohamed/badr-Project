@extends('layout.app')

@section('title_parent') @lang('menu.translations') @endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/select_style/select_style.css')}}">
@endsection

@section('content')

    <div id="app">

        <form action="{{ route('languages.translations.index', ['language' => $language]) }}"
              method="get">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand text-dark" href="#">@lang('global.language')</a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            @include('translation::forms.select', ['name' => 'language', 'items' => $languages, 'submit' => true, 'selected' => $language])
                        </li>
                        <li class="nav-item">

                            @include('translation::forms.select', ['name' => 'group', 'items' => $groups, 'submit' => true, 'selected' => Request::get('group'), 'optional' => true])


                        </li>

                    </ul>
                    @include('translation::forms.search', ['name' => 'filter', 'value' => Request::get('filter')])
                </div>
            </nav>

            @if(count($translations))


                <table class="table">
                    <thead class="thead-light">
                    <tr class="d-flex">
                        <th class="col-4">@lang('global.key')</th>
                        <th class="col-8">{{ $language }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($translations as $type => $items)

                        @foreach($items as $group => $translations)

                            @foreach($translations as $key => $value)

                                <tr class="d-flex">
                                    <td class="col-4">{{ $key }}</td>
                                    <td class="col-8">
                                        <translation-input
                                            initial-translation="{{ $value[$language] }}"
                                            language="{{ $language }}"
                                            group="{{ $group }}"
                                            translation-key="{{ $key }}"
                                            route="{{ config('translation.ui_url') }}">
                                        </translation-input>
                                    </td>
                                </tr>
                            @endforeach

                        @endforeach

                    @endforeach
                    </tbody>
                </table>
            @endif
        </form>


    </div>


@endsection

@section('js')
    <script src="{{ asset('js/translation/app.js') }}"></script>
@endsection
