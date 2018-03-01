@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/activity.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner11.jpg') }}')">
    <h1>@lang('activity::activity.media')</h1>
</section>
<div id="emPAGEcontent" class="container">
@foreach($media as $m)
        <div class="flip cursor"><h4> {{$m->title}} {{ format_time($m->date) }}</h4></div>
        <div class="panel">
                @lang('activity::activity.name'):  {{$m->media}}
                @if($m->type == 'link')
                    <a target="_blank" href="{{ $m->url }}" class="button"><i class="fa fa-link"></i>@lang('activity::activity.link')</a>
                @elseif($m->type == 'server')
                    @if($m->files)
                        @foreach($m->files['files'] as $f)
                            <a target="_blank" href="{{ get_media_file($f->hash_name) }}" class="button"><i class="fa fa-file-pdf-o"></i>@lang('activity::activity.open') PDF</a>
                        @endforeach
                    @endif
                @else
                    <a target="_blank" href="{{ $m->url }}" class="button"><i class="fa fa-link"></i>@lang('activity::activity.link')</a>
                    @if($m->files)
                        @foreach($m->files['files'] as $f)
                            <a target="_blank" href="{{ get_media_file($f->hash_name) }}" class="button"><i class="fa fa-file-pdf-o"></i>@lang('activity::activity.open') PDF</a>
                        @endforeach
                    @endif
                @endif
        </div>
@endforeach
</div>    
@stop