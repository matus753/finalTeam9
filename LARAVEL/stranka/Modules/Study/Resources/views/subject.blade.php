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

            @if(count($subcats) == 0)
            <h3 style="text-align: center">@lang('study::study.no_data')</h3>
            @else
            @foreach($subcats as $s)
                <div>
                    @if(session()->get('locale') === 'sk')
                        <h5 class="ustavTitle" id="secH32">{{$s->name_sk}}</h5>
                    @else
                        <h5 class="ustavTitle" id="secH32">{{$s->name_en}}</h5>
                    @endif

                    <div>
                        @if(session()->get('locale') === 'sk')
                            {{$s->text_sk}}
                        @else
                            {{$s->text_en}}
                        @endif
                    </div>
                </div>
            @endforeach
            @endif


            </div>
        </div>
@stop