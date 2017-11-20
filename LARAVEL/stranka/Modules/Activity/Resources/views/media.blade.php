@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div id="emPAGEcontent" class="container">
cez m sa dostavate k objektom
@foreach($media as $m)

@endforeach
</div>    
@stop