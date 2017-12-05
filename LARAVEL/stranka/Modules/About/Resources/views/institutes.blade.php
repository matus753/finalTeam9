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
        <hr class="aboutUsHR" >
        <div class="row" id="departments">
            <div class="col-md-12" >
                <div class="sectionDiv">
                    <div id="sectContent3">
                        <h3 class="sectionH2 sectItem" id="secH3">Oddelenia ústavu automobilovej mechatroniky</h3>
                        <!--Department 1 -->
                        <div id="department1">
                            <h4 class="sectItem" id="secH31">Oddelenie aplikovanej mechaniky a mechatroniky (OAMM)</h4>
                            <div id="sectContent31">
                                <div class="row col-lg-12">
                                    <div class="col-md-2">
                                        <p>Vedúci: </p>
                                        <p>Zástupca: </p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>prof. Ing. Justín Murín, DrSc.</p>
                                        <p>doc. Ing. Vladimír Kutiš, PhD.</p>
                                    </div>
                                </div>
                                <p>Oddelenie v rámci pedagogiky zabezpečuje v bakalárskom stupni ŠP výučbu predmetov s hlavným dôrazom na mechaniku a mechatronické prvky. V inžinierskom stupni ŠP zabezpečuje výučbu predmetov s dôrazom na simuláciu a modelovanie mechanických a mechatronických systémov tak z pohľadu mechaniky a dynamiky, ako aj z pohľadu multifyzikálneho previazania jednotlivých fyzikálnych domén.</p>
                                <p>Členovia oddelenia sa venujú formulácii nových matematických postupov a metód, ktoré sa používajú v multifyzikálnych analýzach napr. na opis funkcionálne gradovaných materiálov (FGM), v dynamických analýzach mechatronických a MEMS systémov, ako aj na opis piezoelektrických prvkov.</p>
                                <p>Členovia oddelenia využívajú moderné SW prostriedky, ako sú ANSYS, Catia a MSC.ADAMS na návrh, analýzu a optimalizáciu jednotlivých komponentov, ako aj celých subsystémov mechatronických prvkov.</p>
                            </div>
                        </div>
                        <!--Department 2 -->
                        <div id="department2" class="sectionDiv">
                            <h4 class="sectItem" id="secH32">Oddelenie informačných, komunikačných a riadiacich systémov (OIKR)</h4>
                            <div id="sectContent32">
                                <div class="row col-lg-12">
                                    <div class="col-md-2">
                                        <p>Vedúci: </p>
                                        <p>Zástupca: </p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>doc. Ing. Danica Rosinová, PhD.</p>
                                        <p>doc. Ing. Katarína Žáková, PhD.</p>
                                    </div>
                                </div>
                                <p>Informácie budú dodané neskôr.</p>
                            </div>
                        </div>
                        <!--Department 3 -->
                        <div id="department3" class="sectionDiv">
                            <h4 class="sectItem" id="secH33">Oddelenie elektroniky, mikropočítačov a PLC systémov (OEMP)</h4>
                            <div id="sectContent33">
                                <div class="row col-lg-12">
                                    <div class="col-md-2">
                                        <p>Vedúci: </p>
                                        <p>Zástupca: </p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>prof. Ing. Štefan Kozák, PhD.</p>
                                        <p>Ing. Richard Balogh, PhD.</p>
                                    </div>
                                </div>
                                <p>Informácie budú dodané neskôr.</p>
                            </div>
                        </div>
                        <!--Department 4 -->
                        <div id="department4" class="sectionDiv">
                            <h4 class="sectItem" id="secH34">Oddelenie E-mobility, automatizácie a pohonov (OEAP)</h4>
                            <div id="sectContent34">
                                <div class="row col-lg-12">
                                    <div class="col-md-2">
                                        <p>Vedúci: </p>
                                        <p>Zástupca: </p>
                                    </div>
                                    <div class="col-md-10">
                                        <p>prof. Ing. Mikuláš Huba, PhD.</p>
                                        <p>prof. Ing. Viktor Ferencey, CSc.</p>
                                    </div>
                                </div>
                                <p>Informácie budú dodané neskôr.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('js/scripty_aboutUs.js') }}"></script>
@stop
