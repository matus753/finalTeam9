@extends('base_structure')

@section('additional_headers')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
    <section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner7.jpg') }}')">
        @if(session()->get('locale') === 'sk')
            <h1 >{{$subject->title}}</h1>
        @else
            <h1 >{{$subject->title_en}}</h1>
        @endif
    </section>
    <div id="emPAGEcontent" class="printDiv">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h4>{{ $subcat->name }}<h4>
                    </div>                
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    {!! $subcat->text !!}
                </div>
            </div>
            @if(count($files))
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p>Súbory</p>
                @foreach($files as $f)
                    <div>
                        <a href="{{ get_subjects_file($subject->hash_name, $subcat->hash_name, $f->hash_name) }}" >{{ $f->file_name }}</a>
                    </div>
                @endforeach
                </div>
            </div>
            @endif
            </div>
        </div>
@stop