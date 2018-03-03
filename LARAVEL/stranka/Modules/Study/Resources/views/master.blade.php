@extends('base_structure')

@section('additional_headers')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
    <section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner_study6.jpeg') }}')">
        <h1>@lang('study::study.titleMS')</h1>
    </section>
    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="generalInfo">
                        <h3>@lang('study::study.generalInfo')</h3>
                        <div class="generalInfoContent">
                            <div class="jumbotron">
                                <h4 class="hStudy bold">@lang('study::study.scheduleMS')</h4>
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
                                        <tr><th colspan="2">@lang('study::study.endMS')</th></tr>
                                        <tr><td>@lang('study::study.thesisTitleMS')</td><td>13. 02. 2017</td></tr>
                                        <tr><td>@lang('study::study.endThesisMS')</td><td>19. 05. 2017</td></tr>
                                        <tr><td>@lang('study::study.stateExam')</td><td>13. 06. 2017 – 16. 06. 2017</td></tr>
                                        <tr><td>@lang('study::study.graduationMS') </td><td>10. 07. 2017 – 14. 07. 2017</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p>@lang('study::study.studyPlan') 2016-2017 <a href="{{ URL::asset('docs/SP20162017b.pdf') }}" target="_blank" >SP20162017b.pdf</a></p>
                            <p>@lang('study::study.studyOrder') (<a href="{{ URL::asset('docs/studijny_poriadok.pdf') }}" target="_blank" >studijny_poriadok.pdf</a>)</p>
                            <p>@lang('study::study.classification') (<a href="{{ URL::asset('docs/studijny_poriadok.pdf') }}" target="_blank" >klasifikacna_stupnica.pdf</a>)</p>
                        </div>
                    </div>
                    <div class="dpPrace">
                        <h3>@lang('study::study.thesisMS')</h3>
                        <div class="dpPraceContent">
                            <h4 class="bold">@lang('study::study.howTo')</h4>
                            <div>
                                <div class="hKoniecDiv">
                                    <button type="button" class="btn lg" id="btnTogDP1">@lang('study::study.titleDP') 1 <span id="btnDp1" class="fa fa-arrow-circle-o-down" aria-hidden="true"></span></button>
                                    <div id="tableDP1" class="jumbotron">
                                        <table class="table">
                                            <!--<tr><th colspan="2">Bakalársky projekt 1</th></tr>-->
                                            <tr><td>@lang('study::study.headPerson')</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                            <tr><td>@lang('study::study.evalOfSubject')</td><td>@lang('study::study.credit')</td></tr>
                                            <tr><td>@lang('study::study.time')</td><td>@lang('study::study.timeResponseMS'), @lang('study::study.summerTermText')</td></tr>
                                            <tr><td colspan="2">@lang('study::study.infoDP1')</td></tr>
                                        </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDP2">@lang('study::study.titleDP') 2 <span id="btnDp2" class="fa fa-arrow-circle-o-down" aria-hidden="true"></span></button>
                                    <div id="tableDP2" class="jumbotron">
                                        <table class="table">
                                            <tr><td>@lang('study::study.headPerson')</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                            <tr><td>@lang('study::study.evalOfSubject')</td><td>@lang('study::study.credit')</td></tr>
                                            <tr><td>@lang('study::study.time')</td><td>@lang('study::study.timeResponseMS2'), @lang('study::study.winterTermText')</td></tr>
                                            <tr><td colspan="2">@lang('study::study.infoDP2')
                                                </td></tr>
                                        </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDP3">@lang('study::study.titleDP') 3 <span id="btnDp3" class="fa fa-arrow-circle-o-down" aria-hidden="true"></span></button>
                                    <div id="tableDP3" class="jumbotron">
                                        <table class="table">
                                            <tr><td>@lang('study::study.headPerson')</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                            <tr><td>@lang('study::study.evalOfSubject')</td><td>@lang('study::study.credit')</td></tr>
                                            <tr><td>@lang('study::study.time')</td><td>@lang('study::study.timeResponseMS2'), @lang('study::study.summerTermText')</td></tr>
                                            <tr><td colspan="2"><p>@lang('study::study.DP3A')</p>
                                                    <p>1.	@lang('study::study.DP32')</p>
                                                    <p>2.	@lang('study::study.DP3B')</p>
                                                    <p>@lang('study::study.DP33')</p>
                                                    <p>@lang('study::study.DP34')</p>
                                                </td></tr>
                                        </table>
                                    </div>
                                    <button type="button" class="btn lg" id="btnTogDZP">@lang('study::study.finalThesisDP')<span id="btnDp4" class="fa fa-arrow-circle-o-down" aria-hidden="true"></span></button>
                                    <div id="tableDZP" class="jumbotron">
                                        <table class="table">
                                            <tr><td>@lang('study::study.headPerson')</td><td>prof. Ing. Mikuláš Huba, PhD.</td></tr>
                                            <tr><td>@lang('study::study.evalOfSubject')</td><td>@lang('study::study.finalExam')</td></tr>
                                            <tr><td>@lang('study::study.time')</td><td>@lang('study::study.timeResponseMS2'), @lang('study::study.summerTermText')</td></tr>
                                            <tr><td colspan="2">@lang('study::study.infoDZP').
                                                </td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="freeTopics hover">
                                <h4 class="bold">@lang('study::study.freeThesis')</h4>
                                <a href="{{ url('/thesis') }}/{{ 2 }}" target="_self"><button id="btnAv" type="button" class="btn lg" >@lang('study::study.goTo') @lang('study::study.available') @lang('study::study.master') @lang('study::study.thesis')<span id="btnAvArr" class="fa fa-arrow-circle-o-right" aria-hidden="true"></span></button></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="{{ URL::asset('js/scripty_study.js') }}"></script>
@stop