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
                        <h3>Informácie o kategórií {{ $info->name }}</h3>
                    </div>
                </div>
            </div>
            @if($info->text)
            <hr>
            <div class="row">
                <div class="col-md-12">
                    {!! $info->text !!}
                </div>
            </div>
            @endif
            @if(count($files) > 0)
            <hr>
                <h3 class="text-center">Súbory</h3>
                @foreach($files as $f)
                    <div class="row">
                        <div class="col-md-12">
                           <a href="{{ get_subjects_file($subject_hash, $info->hash_name, $f->hash_name) }}">{{ $f->file_name }}</a>
                        </div>
                    </div>
                @endforeach
            @endif
		</div>
	</div>
</div>  

@stop