@extends('base_structure')

@section('additional_headers')
    <link rel="stylesheet" href="{{ URL::asset('css/aboutUs.css') }}">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner_study2.jpeg') }}')">
    <h1>@lang('about::aboutUs.history')</h1>
    </section>
    <div id="emPAGEcontent">
        <div class="container">
                <div class="sectContent">
                    <p class="sectText">@lang('about::aboutUs.historytext1')</p>
                    <p class="sectText">@lang('about::aboutUs.historytext2')</p>
                    <p class="sectText">@lang('about::aboutUs.historytext3')</p>
                </div>
        </div>
    </div>
@stop
