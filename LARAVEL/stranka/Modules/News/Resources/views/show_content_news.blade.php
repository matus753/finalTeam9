@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/ib_style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner4.jpg') }}')">
	<h1>@lang("news::news.title")</h1>
</section>
<div id="emPAGEcontent" class="container">
    <div class="row">
        <h1 class="display-4">
            {{ $title }}
        </h1>
    </div>
    <div class="row">
        {!! $content !!}
    </div>
    <div class="row">
        @if($added_files)
            @foreach($added_files as $a)
                <a target="_blank" href="{{ get_news_image($a->hash_id, $a->file_hash) }}">{{ $a->file_name }}</a>
            @endforeach
        @endif
    </div>
</div>   
 
@stop
