@extends('layout.app')

@section('title_parent') @lang('menu.settings') @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/dropify/dist/css/dropify.min.css')}}">
@endsection
@section('content')

                    <h4 class="m-b-4 text-center">@lang('setting.manage_settings')</h4>



                    {!! Form::open(array('url' => '/settings/update', 'method' => 'post' ,'class' => 'form-horizontal form-bordered','id'=>'formUpdateSettings'))!!}
                    <div class="form-body">
                        @foreach($settings ?? '' ?? '' as $setting)

                                <div class="form-group row">
                                    <label for="input-file-now-custom-1"
                                           class="control-label col-md-3">@lang('setting.'.$setting->name)</label>
                                    <div class="col-md-9">
                                        @if($setting->name == 'logo')
                                            <input type="file" id="input-file-now-custom-1" name="{{$setting->name}}"
                                                   class="dropify"
                                                   data-height="70" value="{{$setting->value}}"
                                                   data-default-file="{{asset('images/settings/'.$setting->value)}}"/>

                                        @else
                                            <input type="text" name="{{$setting->name}}"
                                                   placeholder="@lang('setting.'.$setting->name)"
                                                   class="form-control" value="{{$setting->value}}">
                                        @endif
                                    </div>

                                </div>

                        @endforeach
                    </div>
                    @can('update_settings')
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="offset-sm-5 col-md-6">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
                                                @lang('global.submit')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                    {!! Form::close() !!}

@endsection

@section('js')
    @include('globalComponents.dropifyJs');
    <script src="{{asset('js/setting/setting.js')}} "></script>
@endsection()
