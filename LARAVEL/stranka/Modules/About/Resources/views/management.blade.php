@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/aboutUs.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner_study2.jpeg') }}')">
    <h1>O nás</h1>
</section>
<div id="emPAGEcontent">
    <div class="container">
        <hr class="aboutUsHR">
        <div class="row" >
            <div class="col-md-12" id="hoi">
                <div class="sectionDiv">
                    <h3 class="sectionH2 sectItem" id="secH2">@lang('about::aboutUs.management')</h3>
                    <div id="sectContent2" class="row">
                        <div class="col-md-6">
                            <p>@lang('about::aboutUs.head')</p>
                            <p>@lang('about::aboutUs.deputy1')</p>
                            <p>@lang('about::aboutUs.deputy2')</p>
                            <p>@lang('about::aboutUs.deputy3')</p>
                        </div>
                        <div class="col-md-6">
                            <p>prof. Ing. Mikuláš Huba, PhD.</p>
                            <p>prof. Ing. Justín Murín, DrSc.</p>
                            <p>prof. Ing. Štefan Kozák, PhD.</p>
                            <p>doc. Ing. Katarína Žáková, PhD.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('js/scripty_aboutUs.js') }}"></script>
@stop
