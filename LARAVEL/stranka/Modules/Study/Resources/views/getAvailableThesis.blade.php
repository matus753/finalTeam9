@extends('base_structure')

@section('additional_headers')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
    <section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner_study3.jpeg') }}')">
        {{--<h1>@lang('study::study.titleBS')</h1>--}}
        <h1 >Voľné {{$typ}} témy</h1>
    </section>
    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loading"  style="text-align: center;">
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw waitIcon"></i>
                    </div>
                        <div class="loaded" data-href="{{ url('/thesis/filter') }}" data-type="{{$typId}}">
                    <div id="thesisFilter" class="form-group form-inline" style="text-align: right;">
                        <label class="filterLabel" for="ustavSelect">Ústav</label>
                        <select id="ustavSelect" class="form-control input-sm" data-href="{{ url('/thesis/filter') }}" >
                            <option value="642" selected>Ústav automobilovej mechatroniky</option>
                            <option value="548" >Ústav elektroenergetiky a aplikovanej elektrotechniky</option>
                            <option value="549" >Ústav elektroniky a fotoniky</option>
                            <option value="550" >Ústav elektrotechniky</option>
                            <option value="816" >Ústav informatiky a matematiky</option>
                            <option value="817" >Ústav jadrového a fyzikálneho inžinierstva</option>
                            <option value="818" >Ústav multimediálnych informačných a komunikačných technológií</option>
                            <option value="356" >Ústav robotiky a kybernetiky</option>
                        </select>

                        <label class="filterLabel" for="programSelect">Študiný program</label>
                        <select id="programSelect" class="form-control input-sm" data-href="{{ url('/thesis/filter') }}" >
                            <option value="" selected>všetky</option>
                        </select>
                        <label class="filterLabel" for="inputFind">Hľadať v názvoch: </label>
                        <input id="inputFind" type="text" onkeyup="findThesis()" class="form-control form-control-sm input-sm">
                    </div>



                    <div class="tableDiv">
                        <table id="SS-table-themes-BP" class="table table-hover">
                            <thead>
                            <tr class="category">
                                <th onclick="sortTable(0)" style="cursor:pointer" class="col-sm-8"><i class="fa fa-sort"></i> Názov projektu</th>
                                <th onclick="sortTable(1)" style="cursor:pointer; text-align: center" class="center col-sm-2"><i class="fa fa-sort"></i> Meno školiteľa</th>
                                <th onclick="sortTable(2)" style="cursor:pointer; text-align: center" class="center col-rm-2"><i class="fa fa-sort"></i> Študiný program</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                            <div class="nothing" style="text-align: center; "><p>Nenašli sa žiadne vyhovujúce záznamy.</p></div>


                            <div id="thesisBtn">
                                <a href="{{ url('/') }}/{{$urlBack}}" id="goBackBtn" class="btn btn-default" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Späť na {{$typ}} štúdium</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/scripty_themes.js') }}"></script>
@stop