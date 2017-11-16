@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="hlNadpis">3D LED kocka</h1>
                <hr>
                <div>
                    <img src="https://lh4.googleusercontent.com/wXXCAZyOuYBitXbSHGipRQVpm2lNiF3ZvX2cBBft-JU4u3HzAHro47o1X0dzB3paxeX2yEGW07i8yE-qbCQc5qdTCyKFnQkcGZZHp7SZX6hVfGvWCW1m_kZMeXFT28ffuGAc6rc" alt="Kocka" style="width:100%;height:100%">
                    <br><br>
                    <p>
                        Zobrazená kocka bola vytvorená v rámci diplomovej práce. Bol k nej vytvorený vzdialený prístup cez Internet, čo umožňuje užívateľovi vkladať do kocky vlastný kód, ktorý ovplyvňuje jej správanie sa.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>   
@stop