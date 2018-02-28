@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/led-cube.jpg') }}')">
    <h1>@lang('research::research.kocka')</h1>
</section>
<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <p style="margin-top: 30px; margin-bottom: 40px;">
                        @lang('research::research.kockaPopis')
                    </p>
                    <img src="https://lh4.googleusercontent.com/wXXCAZyOuYBitXbSHGipRQVpm2lNiF3ZvX2cBBft-JU4u3HzAHro47o1X0dzB3paxeX2yEGW07i8yE-qbCQc5qdTCyKFnQkcGZZHp7SZX6hVfGvWCW1m_kZMeXFT28ffuGAc6rc" alt="Kocka" style="width:100%;height:100%; margin-bottom: 80px;">

                </div>
            </div>
        </div>
    </div>
</div>   
@stop