@extends('base_structure')

@section('additional_headers')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
    <section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner7.jpg') }}')">
        <h1>LALALALALA</h1>
    </section>
    <div id="emPAGEcontent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="generalInfo">
                        <h3>@lang('study::study.generalInfo')</h3>
                        <div class="generalInfoContent">
                                <p class="doplnit">@lang('study::study.infoLater')</p>
                        </div>
                        @foreach($subjects as $key => $subject)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ $subject->abbrev }}</th>
                                        <th>{{ $subject->title }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($subject->subcategories as $s)
                                    <tr>
                                        <td>{{ $subject->abbrev }}</td>
                                        <td>{{ $s->name_sk }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div>
    <script src="{{ URL::asset('js/scripty_study.js') }}"></script>
@stop