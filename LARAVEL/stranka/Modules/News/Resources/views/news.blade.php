@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/ib_style.css') }}" rel="stylesheet">
@stop

@section('content')

<div id="emPAGEcontent" class="container">
        <div class="row" style="margin-bottom: 10px">
            <div class="ib-inline ib-left">
                <div class="ib-in">
                    <h3>Aktuality</h3>
                </div>
                <div class="ib-in">
                    <button type='button' class='btn  ib-add' data-toggle='modal' data-target='#newsletter'>Newsletter</button>
                </div>
            </div>
            <div class="ib-inline ib-right">
                Typ:
                <select onchange="updateType()" id="ib-news-select">
                    <option>Propagácia</option>
                    <option>Oznamy</option>
                    <option>Zo života ústavu</option>
                    <option selected>Všetky</option>
                </select>

                Expirované:
                <input id="ib-news-chb" type="checkbox" onclick="toggleExpired()">

               
            </div>
<!--            <hr>-->
        </div>

    <div class="row" id="news-content">
        <div class="col-md-12">

        </div>
    </div>
</div>    
@stop
