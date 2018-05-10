@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content_admin')
<div id="emPAGEcontent" class="container">
    <div class="intra-div">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="pull-left">
                    <a href="{{ url('/documents-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                </div>
                <h2>{{ $document->name_sk }}</h2>
            </div>
        </div>
        @if(isset($document->text_sk) && !empty($document->text_sk))
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! $document->text_sk !!}<br>
            </div>
        </div>
        @endif
        @if(count($files) > 0)
            @foreach($files as $f)
            <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                    <span class="fa fa-download"></span>&nbsp;<a href="{{ get_documents_file($category_hash->hash_name, $document->hash_name, $f->file_hash) }}" target="_blank" >{{ $f->file_name }}</a>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@stop