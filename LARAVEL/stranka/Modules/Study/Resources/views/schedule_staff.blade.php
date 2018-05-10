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
                                <td style="width: 5%;">{{ $key }}</td>
                                @for($i =0; $i < 15; $i++)
                                    <td colspan="@if(is_array($sd[$i+7]) && !isset($sd[$i+8]) && empty($sd[$i+8]) ) {{ $sd[$i+7]['duration'] }} @endif" class="text-center" style="width: 5%;background-color:@if(is_array($sd[$i+7]) ) @if(count($sd[$i+7]['abb']) > 1 || (isset($sd[$i+8]) && !empty($sd[$i+8])) || (isset($sd[$i+6]) && !empty($sd[$i+6])) ) {{ $override_color }} @else {{ $sd[$i+7]['color'] }} @endif  @endif">
                                    @if(is_array($sd[$i+7]))
                                        <p>
                                            @foreach($sd[$i+7]['room'] as $key => $r)
                                            <small>{{ $r }}</small> @if(count($sd[$i+7]['room']) - 1 > $key){{ "," }}@endif
                                            @endforeach
                                        <p>
                                        <p>
                                            @foreach($sd[$i+7]['abb'] as $key => $t)
                                            <small>{{ $t }}</small> @if(count($sd[$i+7]['abb']) - 1 > $key){{ "," }}@endif
                                            @endforeach
                                        <p>
                                        <p>
                                            @foreach($sd[$i+7]['teachers'] as $key => $t)
                                            <small>{{ $t }}</small> @if(count($sd[$i+7]['teachers']) - 1 > $key){{ "," }}@endif
                                            @endforeach
                                        <p>
                                        @if(!isset($sd[$i+8]) && empty($sd[$i+8]))
                                        @php
                                            $i += ($sd[$i+7]['duration'] - 1);
                                        @endphp
                                        @endif
                                    @endif 
                                </td>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-12">
                @foreach($subject_assignment as $key => $sub)
                    @foreach($sub as $ss)
                        @foreach($all_staff as $as)
                            @if($key == $as->s_id)
                            <h4>{{ $as->title1 }}&nbsp;{{ $as->name }}&nbsp;{{ $as->surname }}&nbsp;{{ $as->title2 }} <small>{{ $ss }}</small></h4>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
<script>
    $(document).ready(function(){
        $('#schedule_table').fadeIn("slow");
        $('.selectpicker').selectpicker();
    });

</script>
@stop