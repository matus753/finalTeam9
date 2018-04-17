@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

@stop

@section('content_admin')
<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('/subjects-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Informácie o predmete {{ $subject->title }}</h3>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p>Trvanie prednášky: {{ $subject->duration_p}} </p>
                    <p>Trvanie cvičenia: {{ $subject->duration_c}} </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! $info->info !!}
                </div>
            </div>
		</div>
	</div>
</div>  

@stop