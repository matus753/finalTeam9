@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="hlNadpis">Biomechatronika</h1>
                <hr>
                <div>
                    <img src="http://uamt.fei.stuba.sk/web/sites/subory/vedecke_materialy/biomechatronika.jpg" alt="Biomechatronika" style="width:100%;height:100%">
                </div>
            </div>
        </div>
    </div>
</div>   
@stop