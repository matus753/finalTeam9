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
                        <p>Ústav automobilovej mechatroniky bol zriadený k 1. júlu 2013 ako pedagogické a vedecko-výskumné pracovisko Fakulty elektrotechniky a informatiky STU v Bratislave. Zriadenie ústavu Automobilovej mechatroniky bolo logickým vyústením zámerov  vedenia Fakulty elektrotechniky a informatiky STU v Bratislave vytvoriť taký ústav, ktorý by zohľadňoval súčasné požiadavky a potreby automobilového priemyslu  na  Slovensku  s  hlavným  cieľom  pripravovať  absolventov bakalárskeho a  inžinierského štúdia pre oblasť automobilovej mechatroniky.</p>
                        <p>V súčasnosti Ústav automobilovej mechatroniky zabezpečuje výskum, vývoj a vzdelávanie  vo viacerých  oblastiach aplikovanej mechatroniky so špeciálnym dôrazom vo sfére  automobilovej mechatroniky  a  mechatronických  systémov  na  základe  integrácie  a synergie mechanických, elektronických,   informačných,   komunikačných   a   riadiacich   technológií   do   komplexných mechatronických systémov automobilov.</p>
                        <p>Ústav garantuje študijné programy vo všetkých stupňoch štúdia akreditovaných na STU v Bratislave. Pre  širokospektrálnu  oblasť  výučby  a  výskumu  zabezpečuje  integráciu  výskumníkov  a pedagógov  z  FEI STU do výskumného a výučbového procesu v jednotlivých študijných programoch.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('js/scripty_aboutUs.js') }}"></script>
@stop
