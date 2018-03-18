@extends('base_structure')

@section('additional_headers')
    <link rel="stylesheet" href="{{ URL::asset('css/aboutUs.css') }}">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <script type="text/javascript"  src="{{URL::asset('js/about.js')}}"></script>
@stop

@section('content')
<section class="banner banner--center banner--nmargin" style="background-image: url('{{ URL::asset('images/banners/banner_study2.jpeg') }}')">
    <h1>@lang('about::aboutUs.deps')</h1>
</section>
<div class="submenu">
    <div class="container">
        <div class="row">
            <ul>
                <li><a href="#dep_OAMM" class="submenu__item">OAMM</a></li>
                <li><a href="#dep_OIKR" class="submenu__item">OIKR</a></li>
                <li><a href="#dep_OEMP" class="submenu__item">OEMP</a></li>
                <li><a href="#dep_OEAP" class="submenu__item">OEAP</a></li>
            </ul>
        </div>
    </div>
</div>
<div>
    <div class="container">
        <!--Department 1 -->
        <div class="sectContent" id="dep_OAMM">
                <h4 class="ustavTitle">@lang('about::aboutUs.depOAMM')</h4>
                <div class="sectText row col-lg-12">
                    <div class="col-md-2">
                        <p class="bold">@lang('about::aboutUs.depHead'): </p>
                        <p class="bold">@lang('about::aboutUs.depHead2'): </p>
                    </div>
                    <div class=" col-md-10">
                        @foreach ($vOAMM as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                        @foreach ($zOAMM as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    </div>
                </div>
                <p class="sectText">@lang('about::aboutUs.oamm1')</p>
                <p class="sectText">@lang('about::aboutUs.oamm2')</p>
                <p class="sectText">@lang('about::aboutUs.oamm3')</p>
        </div>

        <!--Department 2 -->
        <div class="sectContent" id="dep_OIKR">
            <h4 class="ustavTitle" id="secH32">@lang('about::aboutUs.depOIKR')</h4>
                <div class="sectText row col-lg-12">
                    <div class="col-md-2">
                        <p class="bold">@lang('about::aboutUs.depHead'): </p>
                        <p class="bold">@lang('about::aboutUs.depHead2'): </p>
                    </div>
                    <div class="col-md-10">
                        @foreach ($vOIKR as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                        @foreach ($zOIKR as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    </div>
                </div>            
            <h5>@lang('about::aboutUs.depOIKRTitle1')</h5>
            <ul>                   
                <li>@lang('about::aboutUs.depOIKRT_li1')</li>
                <li>@lang('about::aboutUs.depOIKRT_li2')</li>
                <li>@lang('about::aboutUs.depOIKRT_li3')</li>
                <li>@lang('about::aboutUs.depOIKRT_li4')</li>
                <li>@lang('about::aboutUs.depOIKRT_li5')</li>
                <li>@lang('about::aboutUs.depOIKRT_li6')</li>
                <li>@lang('about::aboutUs.depOIKRT_li7')</li>
                <li>@lang('about::aboutUs.depOIKRT_li8')</li>
            </ul>
            <img src="images/oddelenia/OIKR1.png" alt="img">
            <img src="images/oddelenia/OIKR2.jpg" alt="img">
            <img src="images/oddelenia/OIKR3.png" alt="img">
        </div>
        <!--Department 3 -->
        <div class="sectContent" id="dep_OEMP">
            <h4 class="ustavTitle" >@lang('about::aboutUs.depOEMP')</h4>
                <div class="sectText row col-lg-12">
                    <div class="col-md-2">
                        <p class="bold">@lang('about::aboutUs.depHead'): </p>
                        <p class="bold">@lang('about::aboutUs.depHead2'): </p>
                    </div>
                    <div class="col-md-10">
                        @foreach ($vOEMP as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                        @foreach ($zOEMP as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    </div>
                </div>
                <p class="sectText">@lang('about::aboutUs.later')</p>
        </div>
        <!--Department 4 -->
        <div class="sectContent" id="dep_OEAP">
            <h4 class="ustavTitle" >@lang('about::aboutUs.depOEAP')</h4>
                <div class=" sectText row col-lg-12">
                    <div class="col-md-2">
                        <p class="bold">@lang('about::aboutUs.depHead'): </p>
                        <p class="bold">@lang('about::aboutUs.depHead2'): </p>
                    </div>
                    <div class="col-md-10">
                        @foreach ($vOEAP as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                        @foreach ($zOEAP as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    </div>
                </div>
                <p class="sectText">@lang('about::aboutUs.later')</p>
        </div>
    </div>

@stop
