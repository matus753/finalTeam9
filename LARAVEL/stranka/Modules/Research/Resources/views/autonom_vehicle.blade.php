@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="hlNadpis">Autonómne vozidlo 6×6</h1>
                <hr>
                <div>
                    <img src="http://uamt.fei.stuba.sk/web/sites/images/vozidlo6x6/dve_vozidla.png" alt="Autonómne vozidlo 6×6" style="width:100%;height:100%">

                    <p>&nbsp;</p>

                    <h3>Technické údaje:</h3>
                    <ul style="list-style-type:square; display: inline-block">
                        <li>Hmotnosť: 12,5kg</li>
                        <li>Rozmery (d x š x v): 614 x 495 x 269 mm</li>
                        <li>Spôsob ovládania: Diaľkové ovládanie, riadené mikroprocesorom</li>
                        <li>Pohon: 6×6, každé koleso samostatne riadené BLDC elektromotorom</li>
                        <li>Celkový výkon elektromotorov: 6x 175W</li>
                        <li>Napájanie motorov: 6x DC/​AC menič</li>
                        <li>Zdroj el. prúdu: 4x Li-​Pol akumulátory</li>
                        <li>Celková kapacita aku­mulá­torov: 13,2 Ah</li>
                    </ul>  <img src="http://uamt.fei.stuba.sk/web/sites/images/Render_ISO.jpg" alt="Autonómne vozidlo 6×6" style="width:40%;height:40%;float:right;">

                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</div>   
@stop