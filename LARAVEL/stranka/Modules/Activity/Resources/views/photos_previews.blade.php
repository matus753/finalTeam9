@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/activity.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/lightbox.css') }}" rel="stylesheet">

@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner14.jpg') }}')">
    <h1>Fotogaléria</h1>
</section>
<div id="emPAGEcontent" class="container">
    <div class="gallery">

        @foreach($categories as $i => $c)
            <h2>{{ $c->title_SK }}</h2>
            <div class="gallery-row style-13" id="gallery-line-{{$i}}" onwheel="onScrollMove(event,'gallery-line-{{$i}}')">
                @foreach($previews[$i] as $j => $data)
                    @foreach($data as $d)
                        <a href="{{ URL::asset('images/photoGallery/Normal/'. $c->folder . '/' . $d->photo) }}" data-lightbox="{{$d->folder}}" data-title="{{$d->title_SK}}">
                            <img src="{{ URL::asset('images/photoGallery/Normal/'. $c->folder . '/' . $d->photo) }}" class="hover-shadow">
                        </a>
                    @endforeach
                @endforeach
            </div>
        @endforeach
        <script type="text/javascript"  src="{{URL::asset('js/galleries/lightbox.js')}}"></script>
        <script type="text/javascript"  src="{{URL::asset('js/galleries/gallery.js')}}"></script>
    </div>
</div>    
@stop