@extends('base_structure')

@section('additional_headers')
    <link rel="stylesheet" href="{{ URL::asset('css/aboutUs.css') }}">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner_study2.jpeg') }}')">
    <h1>@lang('about::aboutUs.management')</h1>
</section>
<div id="emPAGEcontent">
    <div class="container">
        <div class="sectContent row">
            <div class="col-md-6">
                <p class="sectText2 bold">@lang('about::aboutUs.head')</p>
                <p class="sectText2 bold">@lang('about::aboutUs.deputy1')</p>
                <p class="sectText2 bold">@lang('about::aboutUs.deputy2')</p>
                <p class="sectText2 bold">@lang('about::aboutUs.deputy3')</p>
            </div>
            <div class="col-md-6">
                <p class="sectText2">prof. Ing. Mikuláš Huba, PhD.</p>
                <p class="sectText2">prof. Ing. Justín Murín, DrSc.</p>
                <p class="sectText2">prof. Ing. Štefan Kozák, PhD.</p>
                <p class="sectText2">doc. Ing. Katarína Žáková, PhD.</p>
            </div>
        </div>
    </div>
</div>

@stop
