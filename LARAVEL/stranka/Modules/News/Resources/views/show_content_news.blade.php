@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/ib_style.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner4.jpg') }}')">
	<h1>Aktuality</h1>
</section>
<div id="emPAGEcontent" class="container">
    {{ $content->title_sk }}<br>
    {!! $content->editor_content_sk !!}<br>
    @if($added_files)
        @foreach($added_files as $a)
            <a target="_blank" href="{{ get_news_image($content->hash_id, $a->file_hash) }}">{{ $a->file_name }}</a>
        @endforeach
    @endif
</div>   
 
@stop
