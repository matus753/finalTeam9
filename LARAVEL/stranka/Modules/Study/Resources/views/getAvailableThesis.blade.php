@extends('base_structure')

@section('additional_headers')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
    <section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner_study3.jpeg') }}')">
        <h1 >@lang('study::study.available') <span class="thesisType"></span> @lang('study::study.thesis')</h1>
    </section>
    <p id="lang" style="display: none;">@lang('study::study.lang')</p>
    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loading"  style="text-align: center;">
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw waitIcon"></i>
                    </div>
                        <div class="loaded" data-href="{{ url('/thesis/filter') }}" data-type="{{$typId}}">
                    <div id="thesisFilter" class="form-group form-inline" style="text-align: right;">
                        <label class="filterLabel" for="ustavSelect">@lang('study::study.department')</label>
                        <select id="ustavSelect" class="form-control input-sm" data-href="{{ url('/thesis/filter') }}" >
                            <option value="642" selected>@lang('study::study.uamt')</option>
                            <option value="548" >@lang('study::study.ueae')</option>
                            <option value="549" >@lang('study::study.uef')</option>
                            <option value="550" >@lang('study::study.ue')</option>
                            <option value="816" >@lang('study::study.uim')</option>
                            <option value="817" >@lang('study::study.ujfi')</option>
                            <option value="818" >@lang('study::study.umikt')</option>
                            <option value="356" >@lang('study::study.urk')</option>
                        </select>

                        <label class="filterLabel" for="programSelect">@lang('study::study.studyProgram')</label>
                        <select id="programSelect" class="form-control input-sm" data-href="{{ url('/thesis/filter') }}" >
                            <option value="" selected>@lang('study::study.all')</option>
                        </select>
                        <label class="filterLabel" for="inputFind">@lang('study::study.find'): </label>
                        <input id="inputFind" type="text" onkeyup="findThesis()" class="form-control form-control-sm input-sm">
                    </div>



                    <div class="tableDiv">
                        <table id="SS-table-themes-BP" class="table table-hover">
                            <thead>
                            <tr class="category">
                                <th onclick="sortTable(0)" style="cursor:pointer" class="col-sm-8"><i class="fa fa-sort"></i> @lang('study::study.thesisTitle')</th>
                                <th onclick="sortTable(1)" style="cursor:pointer; text-align: center" class="center col-sm-2"><i class="fa fa-sort"></i> @lang('study::study.skolitel')</th>
                                <th onclick="sortTable(2)" style="cursor:pointer; text-align: center" class="center col-rm-2"><i class="fa fa-sort"></i> @lang('study::study.studyProgram')</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                            <div class="nothing" style="text-align: center; "><p>@lang('study::study.nothing')</p></div>


                            <div id="thesisBtn">
                                <a href="{{ url('/') }}/{{$urlBack}}" id="goBackBtn" class="btn btn-default" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('study::study.back') <span class="studyType"></span> @lang('study::study.study')</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/scripty_themes.js') }}"></script>
@stop