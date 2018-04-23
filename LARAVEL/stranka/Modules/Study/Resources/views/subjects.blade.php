@extends('base_structure')

@section('additional_headers')
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/study.css') }}">
    <section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner7.jpg') }}')">
        @if(session()->get('locale') === 'sk')
            <h1 >{{$titleSK}}</h1>
        @else
            <h1 >{{$titleEN}}</h1>
        @endif
    </section>
    <div id="emPAGEcontent printDiv">
        <div class="container subjectsAll">
            <div class="row">
                <div class="col-md-4">
                    <form class="form-inline" action="{{ url('/subjects/'.$id) }}" method="GET">
                        {{ csrf_field() }}
                        <label for="semester"></label>
                        <select class="form-control" name="semester" id="semester">
                            <option value="0" @if($act_sem == 0) {{ 'selected' }} @endif>@lang('study::study.winterTerm')</option>
                            <option value="1" @if($act_sem == 1) {{ 'selected' }} @endif>@lang('study::study.summerTerm')</option>
                        </select>
                        <input type="submit" class="btn btn-primary" value="@lang('study::study.submit')">
                    </form>
                </div>
            </div>
            <br>
            @foreach($subjects as $key => $subject)
                <div class="@if($subject->info){{'cSubject'}}@else{{'cNotClickable'}}@endif" >
                    @if($subject->info)
                    <a class="aLink" href="{{ url('/subject') }}/{{ $subject->sub_id }}">
                    @else
                    <a class="aLink">
                    @endif
                        <i class="fa fa-search-plus cArrow" aria-hidden="true"></i>
                        <p class="cAbbrev" >{{$subject->abbrev}}</p>
                        @if(session()->get('locale') === 'sk')
                            <p class="cTitle" >{{$subject->title}}</p>
                        @else
                            <p class="cTitle" >{{$subject->title_en}}</p>
                        @endif
                    </a>
                </div>
                <div class="cDevider"></div>
            @endforeach
            </div>
        </div>
    <script src="{{ URL::asset('js/scripty_study.js') }}"></script>
@stop