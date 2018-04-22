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
        <div id="dep_OAMM" class="institute">
            <h4 class="ustavTitle">@lang('about::aboutUs.depOAMM')</h4>
            <div class="sectContent row">
                <div class="col-md-2">
                    <p class="bold">@lang('about::aboutUs.depHead')</p>
                </div>
                <div  class="col-md-10">
                    @if(count($vOAMM) == 0)
                        <p>-</p>
                    @else
                        @foreach ($vOAMM as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="sectContent row">
                <div class="col-md-2">
                    <p class="bold">@lang('about::aboutUs.depHead2')</p>
                </div>
                <div  class="col-md-10">
                    @if(count($vOAMM) == 0)
                        <p>-</p>
                    @else
                        @foreach ($zOAMM as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <p class="sectText">@lang('about::aboutUs.oamm1')</p>
            <p class="sectText">@lang('about::aboutUs.oamm2')</p>
            <p class="sectText">@lang('about::aboutUs.oamm3')</p>
        </div>


        <!--Department 2 -->
        <div id="dep_OIKR" class="institute">
            <h4 class="ustavTitle" id="secH32">@lang('about::aboutUs.depOIKR')</h4>
            <div class="sectContent row">
                <div class="col-md-2">
                    <p class="bold">@lang('about::aboutUs.depHead')</p>
                </div>
                <div  class="col-md-10">
                    @if(count($vOIKR) == 0)
                        <p>-</p>
                    @else
                        @foreach ($vOIKR as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="sectContent row">
                <div class="col-md-2">
                    <p class="bold">@lang('about::aboutUs.depHead2')</p>
                </div>
                <div  class="col-md-10">
                    @if(count($zOIKR) == 0)
                        <p>-</p>
                    @else
                        @foreach ($zOIKR as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="sectContent">
            <h5 class="sectText">@lang('about::aboutUs.depOIKRTitle1')</h5>
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
        </div>


        <!--Department 3 -->
        <div id="dep_OEMP" class="institute">
            <h4 class="ustavTitle" >@lang('about::aboutUs.depOEMP')</h4>
            <div class="sectContent row">
                <div class="col-md-2">
                    <p class="bold">@lang('about::aboutUs.depHead')</p>
                </div>
                <div  class="col-md-10">
                    @if(count($vOEMP) == 0)
                        <p>-</p>
                    @else
                        @foreach ($vOEMP as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="sectContent row">
                <div class="col-md-2">
                    <p class="bold">@lang('about::aboutUs.depHead2')</p>
                </div>
                <div  class="col-md-10">
                    @if(count($zOEMP) == 0)
                        <p>-</p>
                    @else
                        @foreach ($zOEMP as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="sectContent">
            <h5 class="sectText">@lang('about::aboutUs.depOEMPTitle1')</h5>
            <ul>
                <li>@lang('about::aboutUs.depOEMP_li1')</li>
                <li>@lang('about::aboutUs.depOEMP_li2')</li>
                <li>@lang('about::aboutUs.depOEMP_li3')</li>
                <li>@lang('about::aboutUs.depOEMP_li4')</li>
                <li>@lang('about::aboutUs.depOEMP_li5')</li>
                <li>@lang('about::aboutUs.depOEMP_li6')</li>
                <li class="sectContentLi">@lang('about::aboutUs.depOEMP_li7')</li>
            </ul>
                </div>
        </div>

        <!--Department 4 -->
        <div id="dep_OEAP" class="institute">
            <h4 class="ustavTitle" >@lang('about::aboutUs.depOEAP')</h4>
            <div class="sectContent row">
                <div class="col-md-2">
                    <p class="bold">@lang('about::aboutUs.depHead')</p>
                </div>
                <div  class="col-md-10">
                    @if(count($vOEAP) == 0)
                        <p>-</p>
                    @else
                        @foreach ($vOEAP as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="sectContent row">
                <div class="col-md-2">
                    <p class="bold">@lang('about::aboutUs.depHead2')</p>
                </div>
                <div  class="col-md-10">
                    @if(count($zOEAP) == 0)
                        <p>-</p>
                    @else
                        @foreach ($zOEAP as $s)
                            <p>@if(strcmp($s->title1, '' > 1)){{$s->title1}}@endif {{$s->name}} {{$s->surname}}@if(strcmp($s->title2, '' > 1)), @endif{{$s->title2}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <p class="sectText">@lang('about::aboutUs.later')</p>
            </div>
    </div>

@stop
