@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner11.jpg') }}')">
    <h1>Média</h1>
</section>
<div id="emPAGEcontent" class="container">
cez m sa dostavate k objektom
@foreach($media as $m)

@endforeach
</div>    
@stop