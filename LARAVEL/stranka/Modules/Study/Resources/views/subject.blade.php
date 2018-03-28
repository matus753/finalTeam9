@extends('base_structure')

@section('additional_headers')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
    <section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner7.jpg') }}')">
            <h1 >{{$subject}}</h1>
    </section>
    <div id="emPAGEcontent">
        <div class="container">
            @if($info)
                <div class="row">
                    <div class="col-md-12">
                        {!! $info->info !!}
                    </div>
                </div>
            @endif
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
        </div>
@stop