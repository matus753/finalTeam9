@extends('base_structure')

@section('additional_headers')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="hlNadpis">@lang('study::study.titleDS')</h1>
                    <div class="generalInfo">
                        <h3>@lang('study::study.generalInfo')</h3>
                        <div class="generalInfoContent">
                                <p class="doplnit">@lang('study::study.infoLater')</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    <script src="{{ URL::asset('js/scripty_study.js') }}"></script>
@stop