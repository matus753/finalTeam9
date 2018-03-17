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
                @foreach ($staff1all as $staff1)
                    <p class="sectText2">@if(strcmp($staff1->title1, '' > 1)){{$staff1->title1}}@endif {{$staff1->name}} {{$staff1->surname}}@if(strcmp($staff1->title2, '' > 1)), @endif{{$staff1->title2}}</p>
                @endforeach
                    @foreach ($staff2all as $staff2)
                        <p class="sectText2">@if(strcmp($staff2->title1, '' > 1)){{$staff2->title1}}@endif {{$staff2->name}} {{$staff2->surname}}@if(strcmp($staff2->title2, '' > 1)), @endif{{$staff2->title2}}</p>
                @endforeach
                    @foreach ($staff3all as $staff3)
                        <p class="sectText2">@if(strcmp($staff3->title1, '' > 1)){{$staff3->title1}}@endif {{$staff3->name}} {{$staff3->surname}}@if(strcmp($staff3->title2, '' > 1)), @endif{{$staff3->title2}}</p>
                @endforeach
                    @foreach ($staff4all as $staff4)
                        <p class="sectText2">@if(strcmp($staff4->title1, '' > 1)){{$staff4->title1}}@endif {{$staff4->name}} {{$staff4->surname}}@if(strcmp($staff4->title2, '' > 1)), @endif{{$staff4->title2}}</p>
                @endforeach
            </div>
        </div>
    </div>
</div>

@stop
