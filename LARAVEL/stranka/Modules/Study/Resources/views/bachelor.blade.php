@extends('base_structure')

@section('additional_headers')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
    <section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner_study3.jpeg') }}')">
        <h1>@lang('study::study.titleBS')</h1>
    </section>
    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="generalInfo">
                        <h3 class="h3Study">@lang('study::study.generalInfo')</h3>
                        <div class="generalInfoContent">
                            <div class="jumbotron">
                                <h4 class="hStudy bold">@lang('study::study.scheduleBS')</h4>
                                <div class="harmonogram">
                                    <table class="table">
                                        <tbody>
                                        <tr><th colspan="2">@lang('study::study.winterTerm')</th></tr>
                                        <tr><td>@lang('study::study.startDate')</td><td>19. 09. 2016</td></tr>
                                        <tr><td rowspan="3">@lang('study::study.vacation')</td><td>31. 10. 2016</td></tr>
                                        <tr><td>18. 11. 2016</td></tr>
                                        <tr><td>23. 12. 2016 – 01. 01. 2017</td></tr>
                                        <tr><td>@lang('study::study.examStartDate')</td><td>02. 01. 2017</td></tr>
                                        <tr><td>@lang('study::study.examEndDate')</td><td>12. 02. 2017</td></tr>
                                        <tr><th colspan="2">@lang('study::study.summerTerm')</th></tr>
                                        <tr><td>@lang('study::study.startDate')</td><td>13. 02. 2017</td></tr>
                                        <tr><td>@lang('study::study.vacation')</td><td>14. 04. 2017 – 18. 04. 2017</td></tr>
                                        <tr><td>@lang('study::study.examStartDate')</td><td>22. 05. 2017</td></tr>
                                        <tr><td>@lang('study::study.examEndDate')</td><td>02. 07. 2017</td></tr>
                                        <tr><th colspan="2">@lang('study::study.endBS')</th></tr>
                                        <tr><td>@lang('study::study.thesisTitleBS')</td><td>13. 02. 2017</td></tr>
                                        <tr><td>@lang('study::study.endThesisBS')</td><td>19. 05. 2017</td></tr>
                                        <tr><td>@lang('study::study.stateExam')</td><td>06. 07. 2017 – 07. 07. 2017</td></tr>
                                        <tr><td>@lang('study::study.graduationBS')</td><td>14. 09. 2016</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p>@lang('study::study.studyPlan') 2016-2017 <a href="{{ URL::asset('docs/SP20162017b.pdf') }}" target="_blank" >SP20162017b.pdf</a></p>
                            <p>@lang('study::study.studyOrder') (<a href="{{ URL::asset('docs/studijny_poriadok.pdf') }}"  target="_blank">studijny_poriadok.pdf</a>)</p>
                            <p>@lang('study::study.classification') (<a href="{{ URL::asset('docs/klasifikacna_stupnica.pdf') }}"  target="_blank">klasifikacna_stupnica.pdf</a>)</p>
                        </div>
                    </div>
                    <div class="bpPrace">
                        <h3>@lang('study::study.thesisBS')</h3>
                        <div class="bpPraceContent">
                            <div >
                                <h4 class="bold">@lang('study::study.howTo')</h4>
                                <div>
                                    <div class="hKoniecDiv">
                                        <!--<p>Bakalársky projekt 1</p>-->
                                        <button type="button" class="btn lg" id="btnTogBP1">@lang('study::study.titleBP') 1 <span id="btnBp1" class="fa fa-arrow-circle-o-down" aria-hidden="true"></span></button>
                                        <div id="tableBP1" class="jumbotron">
                                            <table class="table">
                                                <!--<tr><th colspan="2">Bakalársky projekt 1</th></tr>-->
                                                <tr><td>@lang('study::study.headPerson')</td><td>doc. Ing. Vladimír Kutiš, PhD.</td></tr>
                                                <tr><td>@lang('study::study.evalOfSubject')</td><td>@lang('study::study.credit')</td></tr>
                                                <tr><td>@lang('study::study.time')</td><td>@lang('study::study.timeResponse'), @lang('study::study.winterTermText')</td></tr>
                                                <tr><td colspan="2">@lang('study::study.infoBP1')</td></tr>
                                            </table>
                                        </div>
                                        <button type="button" class="btn lg" id="btnTogBP2">@lang('study::study.titleBP') 2 <span id="btnBp2" class="fa fa-arrow-circle-o-down" aria-hidden="true"></span></button>
                                        <div id="tableBP2" class="jumbotron">
                                            <table class="table">
                                                <tr><td>@lang('study::study.headPerson')</td><td>doc. Ing. Vladimír Kutiš, PhD.</td></tr>
                                                <tr><td>@lang('study::study.evalOfSubject')</td><td>@lang('study::study.credit')</td></tr>
                                                <tr><td>@lang('study::study.time')</td><td>@lang('study::study.timeResponse'), @lang('study::study.summerTermText')</td></tr>
                                                <tr><td colspan="2"><p>@lang('study::study.infoBP2')</p>
                                                        <p>1.	@lang('study::study.infoBP2A')</p>
                                                        <p>2.	@lang('study::study.infoBP2B')</p>
                                                        <p>@lang('study::study.infoBP2C')</p>
                                                        <p>@lang('study::study.infoBP2D')</p>
                                                    </td></tr>
                                            </table>
                                        </div>
                                        <button type="button" class="btn lg" id="btnTogBZP">@lang('study::study.finalThesisBZP') <span id="btnBp3" class="fa fa-arrow-circle-o-down" aria-hidden="true"></span></button>
                                        <div id="tableBZP" class="jumbotron">
                                            <table class="table">
                                                <tr><td>@lang('study::study.headPerson')</td><td>doc. Ing. Vladimír Kutiš, PhD.</td></tr>
                                                <tr><td>@lang('study::study.evalOfSubject')</td><td>@lang('study::study.credit')</td></tr>
                                                <tr><td>@lang('study::study.time')</td><td>@lang('study::study.timeResponse'), @lang('study::study.summerTermText')</td></tr>
                                                <tr><td colspan="2">@lang('study::study.infoBZP')
                                                    </td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="freeTopics hover">
                                <h4 class="bold">@lang('study::study.freeThesis')</h4>
                                <a href="{{ url('/thesis') }}/{{ 1 }}" target="_self"><button id="btnAv" type="button" class="btn lg" >@lang('study::study.goTo') @lang('study::study.available') @lang('study::study.bachelor') @lang('study::study.thesis')<span id="btnAvArr" class="fa fa-arrow-circle-o-right" aria-hidden="true"></span></button></a>
                            </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/scripty_study.js') }}"></script>
@stop