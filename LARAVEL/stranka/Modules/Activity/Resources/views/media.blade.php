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
        <div class="flip cursor"><h4> {{$m->title}} {{ format_time($m->date) }}</h4></div>
        <div class="panel">
                <p>Názov média:  {{$m->media}} </p>
                @if($m->type == 'link')
                    <p><a target="_blank" href="{{ $m->url }}">Klikni pre pokračovanie</a></p>
                @elseif($m->type == 'server')
                    @if($m->files)
                        @foreach($m->files['files'] as $f)
                            <p><a target="_blank" href="{{ get_media_file($f->hash_name) }}">Klikni pre PDF</a></p>
                        @endforeach
                    @endif
                @else
                    <p><a target="_blank" href="{{ $m->url }}">Klikni pre pokračovanie</a></p>
                    @if($m->files)
                        @foreach($m->files['files'] as $f)
                            <p><a target="_blank" href="{{ get_media_file($f->hash_name) }}">Klikni pre PDF</a></p>
                        @endforeach
                    @endif
                @endif
        </div>
@endforeach
</div>    
@stop