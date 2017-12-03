@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner9.jpg') }}')">
    <h1>Elektrická motokára</h1>
</section>
<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <img src="http://uamt.fei.stuba.sk/web/sites/subory/vedecke_materialy/motokara.jpg" alt="E-Kart" style="width:100%;height:100%">
                </div>
            </div>
        </div>
    </div>
</div>   
@stop