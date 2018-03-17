@extends('base_structure')

@section('additional_headers')
    <link rel="stylesheet" href="{{ URL::asset('css/aboutUs.css') }}">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner_study2.jpeg') }}')">
    <h1>@lang('about::aboutUs.deps')</h1>
</section>
<div id="emPAGEcontent">
    <div class="container">
        <!--Department 1 -->
        <div class="sectContent">
                <h4 class="ustavTitle">@lang('about::aboutUs.depOAMM')</h4>
                <div class="sectText row col-lg-12">
                    <div class="col-md-2">
                        <p class="bold">@lang('about::aboutUs.depHead'): </p>
                        <p class="bold">@lang('about::aboutUs.depHead2'): </p>
                    </div>
                    <div class=" col-md-10">
                        <p>prof. Ing. Justín Murín, DrSc.</p>
                        <p>doc. Ing. Vladimír Kutiš, PhD.</p>
                    </div>
                </div>
                <p class="sectText">@lang('about::aboutUs.oamm1')</p>
                <p class="sectText">@lang('about::aboutUs.oamm2')</p>
                <p class="sectText">@lang('about::aboutUs.oamm3')</p>
        </div>

        <!--Department 2 -->
        <div class="sectContent">
            <h4 class="ustavTitle" id="secH32">@lang('about::aboutUs.depOIKR')</h4>
            <div class="sectText row col-lg-12">
                <div class="col-md-2">
                    <p class="bold">@lang('about::aboutUs.depHead'): </p>
                    <p class="bold">@lang('about::aboutUs.depHead2'): </p>
                </div>
                <div class="col-md-10">
                    <p>doc. Ing. Danica Rosinová, PhD.</p>
                    <p>doc. Ing. Katarína Žáková, PhD.</p>
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
        <div class="sectContent">
            <h4 class="ustavTitle" >@lang('about::aboutUs.depOEMP')</h4>
                <div class="sectText row col-lg-12">
                    <div class="col-md-2">
                        <p class="bold">@lang('about::aboutUs.depHead'): </p>
                        <p class="bold">@lang('about::aboutUs.depHead2'): </p>
                    </div>
                    <div class="col-md-10">
                        <p>prof. Ing. Štefan Kozák, PhD.</p>
                        <p>Ing. Richard Balogh, PhD.</p>
                    </div>
                </div>
                <p class="sectText">@lang('about::aboutUs.later')</p>
        </div>
        <!--Department 4 -->
        <div class="sectContent">
            <h4 class="ustavTitle" >@lang('about::aboutUs.depOEAP')</h4>
                <div class=" sectText row col-lg-12">
                    <div class="col-md-2">
                        <p class="bold">@lang('about::aboutUs.depHead'): </p>
                        <p class="bold">@lang('about::aboutUs.depHead2'): </p>
                    </div>
                    <div class="col-md-10">
                        <p>prof. Ing. Mikuláš Huba, PhD.</p>
                        <p>prof. Ing. Viktor Ferencey, CSc.</p>
                    </div>
                </div>
                <p class="sectText">@lang('about::aboutUs.later')</p>
        </div>
    </div>

@stop
