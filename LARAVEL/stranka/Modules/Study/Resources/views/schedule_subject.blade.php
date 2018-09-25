@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

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
            <form class="form-horizontal" method="GET" action="{{ url('/schedule-subject') }}">
                <div class="form-group schedules-form">
                    <label for="select">Predmet</label>
                    <select class="form-control" id="select" name="predmet">
                        @foreach ($subjects as $s) 
                            <option value="{{ $s->sub_id }}" @if($subject) @if($s->sub_id == $subject->sub_id) {{ 'selected' }} @endif @endif>{{ $s->title }}</option>
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
        @if(count($schedule_data))
        <div class="row" id="schedule_table">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%;"></th>
                                @for($i = 0; $i < 15; $i++)
                                    <th class="text-center" style="width: 5%;">
                                        {{ $i+7 }}
                                    </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedule_data as $key => $sd)
                            <tr>
                                <td style="width: 5%; vertical-align: middle;">{{ $key }}</td>
                                @for($i =0; $i < 15; $i++)
                                    @if(isset($sd[$i+7]))
                                        <td colspan="@if(isset($sd[$i+7][0])) {{ $sd[$i+7][0]['duration'] }} @endif" class="text-center" style="vertical-align: middle; width: 5%; background-color:@if(isset($sd[$i+7][0])) {{ $sd[$i+7][0]['color'] }} @endif">
                                        @foreach($sd[$i+7] as $d)
                                            <p>{{ $d['room'] }}</p> 
                                        @endforeach
                                         </td>
                                        @php        
                                            $i += ($d['duration'] - 1);
                                        @endphp
                                    @else
                                       <td></td>
                                    @endif
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#schedule_table').fadeIn("slow");
    });
</script>
@stop