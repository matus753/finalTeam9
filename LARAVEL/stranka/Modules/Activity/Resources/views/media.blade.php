@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner11.jpg') }}')">
    <h1>Média</h1>
</section>
<div id="emPAGEcontent" class="container">
@foreach($media as $m)
        <div class="flip cursor"><h4> {{$m->title}} {{$m->date}}</h4></div>
        <div class="panel">
            <p>Názov média:  {{$m->media}} </p>
            @if($m->type == 'link')
                <p><a target="_blank" href="{{$m->url}}">Klikni pre pokračovanie</a></p>
            @elseif($m->type == 'server')
                <p><a target="_blank" href="{{URL::asset('docs/' . $m->file)}}">Pokračuj na PDF</a></p>
            @else
                <p><a target="_blank" href="{{$m->url}}">Klikni pre pokračovanie</a></p>
                <p><a target="_blank" href="{{URL::asset('docs/' . $m->file)}}">Pokračuj na PDF</a></p>
            @endif
        </div>
@endforeach
</div>    
@stop