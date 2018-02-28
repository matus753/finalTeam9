@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/aboutUs.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner_study2.jpeg') }}')">
    <h1>O nás</h1>
</section>
<div id="emPAGEcontent">
    <div class="container">
        <div class="row" >
            <div class="col-md-12" id="history">
                <div class="sectionDiv">
                    <h3 class="sectionH2 sectItem" id="secH1">@lang('about::aboutUs.history')</h3>
                    <div id="sectContent1">
                        <p>@lang('about::aboutUs.historytext1')</p>
                        <p>@lang('about::aboutUs.historytext2')</p>
                        <p>@lang('about::aboutUs.historytext3')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('js/scripty_aboutUs.js') }}"></script>
@stop
