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
            @if($info)
                <div class="row">
                    <div class="col-md-12">
                        {!! $info->info !!}
                    </div>
                </div>
            @endif
            <br>
            <div class="row">
                <div class="col-md-12">
                    <p>Trvanie prednášky: {{ $subject->duration_p }}</p>
                    <p>Trvanie cvičenia: {{ $subject->duration_c }}</p>
                </div>
            </div>
            <hr>
            @if(count($subcats) == 0)
                <h3 style="text-align: center">@lang('study::study.no_data')</h3>
            @else
                @foreach($subcats as $s)
                    <div>
                        <h5 class="ustavTitle" id="secH32"><a href="{{ url('/show-subject-item/'.$s->ss_id) }}" style="color: white;" >{{ $s->name }}</a></h5>
                    </div>
                @endforeach
            @endif
        </div>
        <br>
    </div>
@stop