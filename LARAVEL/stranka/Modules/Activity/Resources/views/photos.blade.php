@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/activity.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/lightbox.css') }}" rel="stylesheet">
<script type="text/javascript"  src="{{URL::asset('js/galleries/lightbox.js')}}"></script>
<script type="text/javascript"  src="{{URL::asset('js/galleries/activity.js')}}"></script>
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner14.jpg') }}')">
    <h1>@lang('activity::activity.photogallery')</h1>
</section>
<div id="emPAGEcontent" class="container">
    <div class="gallery">

        @foreach($categories as $i => $c)
            <h2>{{ $c->title }}&nbsp;&nbsp;{{ format_time($c->date) }}</h2>
            <div class="gallery-row style-13" id="gallery-line-{{$i}}" onwheel="onScrollMove(event,'gallery-line-{{$i}}')">
                @foreach($photos[$i] as $j => $data)
                    @foreach($data as $d)
                        <a href="{{ get_gallery_photo($c->folder,$d->hash_name) }}" data-lightbox="{{ $c->folder }}" data-title="{{ $c->title }}">
                            <img src="{{ get_gallery_photo($c->folder,$d->hash_name) }}" class="hover-shadow">
                        </a>
                    @endforeach
                @endforeach
            </div>
        @endforeach
        
    </div>
</div>    
@stop