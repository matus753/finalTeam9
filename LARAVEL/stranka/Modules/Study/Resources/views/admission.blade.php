@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner_study4.jpeg') }}')">
    <h1>@lang('study::study.titleAss')</h1>
</section>
<div id="emPAGEcontent">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="section1" class="sectionDiv">

                    <div id="sectContent1">
                        <div class="bpStudy">
                            <h3>@lang('study::study.titleBS')</h3>
                            <p class="doplnit">@lang('study::study.infoLater')</p>
                            <p>@lang('study::study.fullStudyProgram') 2017-20118: <a href="{{ URL::asset('docs/SP20172018b.pdf') }}"  target="_blank">SP20172018b.pdf</a></p>
                            <p>@lang('study::study.moreInfo') <a href="http://www.mechatronika.cool">http://www.mechatronika.cool</a></p>
                        </div>
                        <div class="ingStudy">
                            <h3>@lang('study::study.titleMS')</h3>
                            <p class="question">@lang('study::study.question1')</p>
                            <div class="answers">
                                <p><span class="fa fa-check-circle-o" aria-hidden="true"></span> @lang('study::study.answer11')</p>
                                <p><span class="fa fa-check-circle-o" aria-hidden="true"></span> @lang('study::study.answer12')</p>
                                <p><span class="fa fa-check-circle-o" aria-hidden="true"></span> @lang('study::study.answer13')</p>
                                <p><span class="fa fa-check-circle-o" aria-hidden="true"></span> @lang('study::study.answer14')</p>
                                <p><span class="fa fa-check-circle-o" aria-hidden="true"></span> @lang('study::study.answer15')</p>
                                <p><span class="fa fa-check-circle-o" aria-hidden="true"></span> @lang('study::study.answer16')</p>
                                <p><span class="fa fa-check-circle-o" aria-hidden="true"></span> @lang('study::study.answer17')</p>
                            </div>
                            <p class="question">@lang('study::study.question2')</p>
                            <div class="answers">
                                <p><span class="fa fa-briefcase" aria-hidden="true"></span> @lang('study::study.answer21')</p>
                            </div>
                            <div class="studyProgram jumbotron">
                                <h3 id="toggle1" class="line hover">@lang('study::study.studyProgram') – 1. @lang('study::study.year')</h3><span id="btnTogStudProgram" class="fa fa-arrow-circle-o-down hover" aria-hidden="true"></span>
                                <div class="studyProgramContent">
                                    <div class="winterSem">
                                        <hr class="hrStudy">
                                        <h3 class="bold">@lang('study::study.winterTerm')</h3>
                                        <div class="winterSemContent answers">
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject1') </span>@lang('study::study.subject1Info')</p>
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject2') </span>@lang('study::study.subject2Info')</p>
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject3') </span>@lang('study::study.subject3Info')</p>
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject4') </span>@lang('study::study.subject4Info')</p>
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject5') </span></p>
                                        </div>
                                    </div>
                                    <div class="summerSem">
                                        <hr class="hrStudy">
                                        <h3 class="bold">@lang('study::study.summerTerm')</h3>
                                        <div class="summerSemContent answers">
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject6') </span></p>
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject7') </span>@lang('study::study.subject7Info')</p>
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject8') </span>@lang('study::study.subject8Info')</p>
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject9') </span>@lang('study::study.subject9Info')</p>
                                            <p><span class="fa fa-list-alt"></span> <span class="bold"> @lang('study::study.subject5') </span></p>
                                        </div>
                                    </div>
                                    <hr class="hrStudy">
                                    <div class="pvpElektronika">
                                        <h3 id="toggle2" class="line nazovPVP hover">@lang('study::study.titlePVP')@lang('study::study.electronics') </h3>
                                         <span id="btnTogPVPe" class="fa fa-arrow-circle-o-down hover" aria-hidden="true"></span>
                                        <div class="pvpElektronikaContent answers">
                                            <p><span class="fa fa-microchip"></span> <span class="bold"> @lang('study::study.subject10') </span>@lang('study::study.subject10Info')</p>
                                            <p><span class="fa fa-microchip"></span> <span class="bold"> @lang('study::study.subject11') </span>@lang('study::study.subject11Info')</p>
                                        </div>
                                    </div>
                                    <div class="pvpAutomobily">
                                        <h3 id="toggle3" class="line nazovPVP hover">@lang('study::study.titlePVP')@lang('study::study.automobil') </h3>
                                        <span id="btnTogPVPa" class="fa fa-arrow-circle-o-down hover" aria-hidden="true"></span>
                                        <div class="pvpAutomobilyContent answers">
                                            <p><span class="fa fa-car" aria-hidden="true"></span> <span class="bold"> @lang('study::study.subject12') </span>@lang('study::study.subject12Info')</p>
                                            <p><span class="fa fa-car" aria-hidden="true"></span> <span class="bold"> @lang('study::study.subject13') </span>@lang('study::study.subject13Info')</p>
                                        </div>
                                    </div>
                                    <div class="pvpInformatika">
                                        <h3 id="toggle4" class="line nazovPVP hover">@lang('study::study.titlePVP')@lang('study::study.informatics') </h3>
                                        <span id="btnTogPVPi" class="fa fa-arrow-circle-o-down hover" aria-hidden="true"></span>
                                        <div class="pvpInfoContent answers">
                                            <p><span class="fa fa-desktop" aria-hidden="true"></span> <span class="bold"> @lang('study::study.subject10') </span>@lang('study::study.subject10Info')</p>
                                            <p><span class="fa fa-desktop" aria-hidden="true"></span> <span class="bold"> @lang('study::study.subject14') </span>@lang('study::study.subject14Info')</p>
                                            <p><span class="fa fa-desktop" aria-hidden="true"></span> <span class="bold"> @lang('study::study.subject11') </span>@lang('study::study.subject11Info')</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>@lang('study::study.fullStudyProgram') 2017-2018: <a href="{{ URL::asset('docs/SP20172018b.pdf') }}"  target="_blank">SP20172018b.pdf</a></p>
                            <table class="table tableStudy">
                                <tbody>
                                <tr><th>@lang('study::study.examDate')</th><td>28.6.2017 @lang('study::study.at') 10:00 @lang('study::study.in') D124</td></tr>
                                <tr><th rowspan="5">@lang('study::study.examComitee')</th><td>prof. Ing. Mikuláš Huba, PhD. (@lang('study::study.head'))</td></tr>
                                <tr><td>prof. Ing. Justín Murín, DrSc. (@lang('study::study.head'))</td></tr>
                                <tr><td>prof. Ing. Viktor Ferencey, PhD.</td></tr>
                                <tr><td>prof. Ing. Štefan Kozák, PhD.</td></tr>
                                <tr><td>doc. Ing. Katarína Žáková, PhD.</td></tr>
                                </tbody>
                            </table>
                            <p>@lang('study::study.moreInfo') <a href="http://www.mechatronika.cool">http://www.mechatronika.cool</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="{{ URL::asset('js/scripty_study.js') }}"></script>
@stop