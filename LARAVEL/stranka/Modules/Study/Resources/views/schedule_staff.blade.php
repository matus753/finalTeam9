@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/bootstrap-select.js') }}"></script>
<link href="{{ URL::asset('css/bootstrap-select.css') }}" rel="stylesheet">
@stop
@section('content')

<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner_study4.jpeg') }}')">
    <h1>@lang('study::study.Schedules')</h1>
</section>
<div class="container">
    <div class="row">
        <div class="intra-div">
            <div class="btn-group">
                <div class="dropdown pull-left" style="margin-right: 1em;">
                    <h3>@lang('study::study.schedule_filter')</h3>
                    <button class="btn btn-primary dropdown-toggle schedules-btn" type="button" data-toggle="dropdown">@lang('study::study.Schedules')<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/schedule-subject') }}">@lang('study::study.schedule_subject')</a></li>
                        <li><a href="{{ url('/schedule-staff') }}">@lang('study::study.schedule_staff')</a></li>
                        <li><a href="{{ url('/schedule-rooms') }}">@lang('study::study.schedule_rooms')</a></li>
                        <li><a href="{{ url('/schedule-days') }}">@lang('study::study.schedule_days')</a></li>
                        <li><a href="{{ url('/schedule-departments') }}">@lang('study::study.schedule_departments')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="intra-div">
            <form method="GET" action="{{ url('/schedule-staff') }}">
                <div class="form-group schedules-form">
                    <label for="select">Zamestnanci</label>
                    <select class="form-control selectpicker" data-live-search="true" data-size="5" multiple id="select" name="staff[]">
                        @foreach ($all_staff as $s) 
                            <option value="{{ $s->s_id }}" data-tokens="{{ $s->title1 }} {{ $s->name }} {{ $s->surname }} {{ $s->title2 }}" @if(count($selected_staff) > 0) @foreach($selected_staff as $ss ) @if($s->s_id == $ss) {{ 'selected' }} @endif @endforeach @endif>{{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group schedules-form">
                    <button type="submit" class="btn btn-primary">Zobraz</button>
                    <div class="checkbox" style="display:inline-block; padding-left: 0.5em;">
                        <label><input type="checkbox" name="voidDays" @if($all_days) {{ 'checked' }} @endif>Zobraz prázdne dni</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(count($schedule_data))
    <div class="row" id="schedule_table">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-stripped table-bordered" >
                    <thead>
                        <tr>
                            <th style="width: 5%; border: 1px solid #101010;"></th>
                            @for($i = 0; $i < 15; $i++)
                                <th class="text-center" style="width: 5%; border: 1px solid #101010;">
                                    {{ $i+7 }}:00
                                </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedule_data as $key => $sd)
                            <tr>
                            <td rowspan="{{ count($sd) }}" style="width: 5%; border: 1px solid #101010;  vertical-align: middle;">{{ $key }}</td>
                            @foreach($sd as $day)
                                @for($i =0; $i < 15; $i++)
                                    <td colspan="@if(isset($day[$i+7])) {{ $day[$i+7]['duration'] }} @endif" style="border: 1px solid #101010; @if(isset($day[$i+7])) {{ $clrs[$day[$i+7]['abb']] }} @endif; @if($day[$i+7]['cvicenie'] == 1) {{ 'filter: brightness(180%)' }} @endif;">       
                                    @if(isset($day[$i+7]))
                                        <p><strong>{{ $day[$i+7]['title'] }}</strong></p>
                                        <p>{{ $day[$i+7]['staff']->title1 }}&nbsp;{{ $day[$i+7]['staff']->name }}&nbsp;{{ $day[$i+7]['staff']->surname }}&nbsp;{{ $day[$i+7]['staff']->title2 }}</p>
                                        <p>{{ $day[$i+7]['room']->room }}</p>
                                        @php
                                            $i += ($day[$i+7]['duration'] - 1);
                                        @endphp
                                    @endif
                                    </td>
                                @endfor
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
<script>
    $(document).ready(function(){
        $('#schedule_table').fadeIn("slow");
        $('.selectpicker').selectpicker();
    });

</script>
@stop