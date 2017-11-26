@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCggSU4ruU2Ydfj_m_K_5pz9WZWKFc50ZQ&callback=initMap">
    </script>
    <div id="emPAGEcontent" class="container">
        <div class="col-md-6">
            <div class="ib-contact-left ib-contact-left-1">
                <fieldset>
                    <legend>Ústav</legend>
                    <address>
                        <h4>Ústav automobilovej mechatroniky</h4>
                        <h5>FEI STU</h5>
                        <h5>Ilkovičova 3</h5>
                        <h5>812 19 Bratislava</h5>
                        <h5>Slovenská republika</h5>
                    </address>
                </fieldset>
            </div>
            <div class="ib-contact-left ib-contact-left-2">
                <fieldset>
                    <legend>Sekretariát</legend>
                    <address>
                        <h4>Katarína Kermietová</h4>
                        <h5>Miestnosť D116</h5>
                        <h5>Telefón: +421 (2) 60 291 598</h5>
                    </address>
                </fieldset>
            </div>
        </div>
        <div id="map" class="ib-contact-right ib-contact-right-1 col-md-6">

        </div>
    </div>
@stop
