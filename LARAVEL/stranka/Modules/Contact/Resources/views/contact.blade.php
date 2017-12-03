@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/ib-style.css') }}" rel="stylesheet">
@stop

@section('content')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCggSU4ruU2Ydfj_m_K_5pz9WZWKFc50ZQ&callback=initMap">
    </script>
    <section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner17.jpg') }}')">
        <h1>Kontakt</h1>
    </section>
    <div id="emPAGEcontent" class="container">
        <div class="col-md-6">
            <div class="contact-left">
                <fieldset>
                    <legend><h2 class="hlNadpis">@lang('contact::contact.institute')</h2> </legend>
                    <address>
                        <h4>@lang('contact::contact.stu')</h4>
                        <h4>@lang('contact::contact.fei')</h4>
                        <h5>Ilkovičova 3</h5>
                        <h5>812 19 Bratislava</h5>
                        <h5>@lang('contact::contact.sk')</h5>
                    </address>
                </fieldset>
            </div>
            <div class="contact-left">
                <fieldset>
                    <legend>@lang('contact::contact.secretariat')</legend>
                    <address>
                        <h4>Katarína Kermietová</h4>
                        <h5>@lang('contact::contact.room') D116</h5>
                        <h5>@lang('contact::contact.secretariat'): +421 (2) 60 291 598</h5>
                    </address>
                </fieldset>
            </div>
        </div>
        <div id="map" class="contact-right col-md-6">

        </div>
    </div>
@stop
