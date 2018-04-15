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
            @foreach($subjects as $key => $subject)
                <div class="@if($subject->subcategories->count() != 0){{'cSubject'}}@else{{'cNotClickable'}}@endif" >
                    @if($subject->subcategories->count() != 0)
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
            {{--@foreach($subjects as $key => $subject)--}}
            {{--<div class="table-responsive">--}}
                {{--<table class="table table-bordered table-striped">--}}
                    {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>{{ $subject->abbrev }}</th>--}}
                            {{--<th>{{ $subject->title }}</th>--}}
                        {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--@foreach($subject->subcategories as $s)--}}
                        {{--<tr>--}}
                            {{--<td>{{ $subject->abbrev }}</td>--}}
                            {{--<td>{{ $s->name_sk }}</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
            {{--@endforeach--}}
            </div>
        </div>
    <script src="{{ URL::asset('js/scripty_study.js') }}"></script>
@stop