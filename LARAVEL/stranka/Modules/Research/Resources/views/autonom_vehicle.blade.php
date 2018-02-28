@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner3.jpg') }}')">
    <h1>@lang('research::research.auto')</h1>
</section>
<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <img src="http://uamt.fei.stuba.sk/web/sites/images/vozidlo6x6/dve_vozidla.png" alt="Autonómne vozidlo 6×6" style="width:100%;height:100%">

                    <p>&nbsp;</p>

                    <h3>@lang('research::research.techudaj'):</h3>
                    <ul style="list-style-type:square; display: inline-block">
                        <li>@lang('research::research.hmotnost')</li>
                        <li>@lang('research::research.rozmery')</li>
                        <li>@lang('research::research.ovladanie')</li>
                        <li>@lang('research::research.pohon')</li>
                        <li>@lang('research::research.vykon')</li>
                        <li>@lang('research::research.motor')</li>
                        <li>@lang('research::research.zdroj')</li>
                        <li>@lang('research::research.kapacita')</li>
                    </ul>  <img src="http://uamt.fei.stuba.sk/web/sites/images/Render_ISO.jpg" alt="Autonómne vozidlo 6×6" style="width:40%;height:40%;float:right;">

                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</div>   
@stop