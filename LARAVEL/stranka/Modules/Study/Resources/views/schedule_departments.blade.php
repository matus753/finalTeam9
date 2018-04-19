@extends('base_structure')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

@stop
@section('content')

<div class="container">
    <div class="row">
        <div class="intra-div">
            <h2>ÚAMT Rozvrhy</h2>
        </div>
    </div>
    <div class="row">
        <hr>
        <div class="intra-div">
            <div class="btn-group">
                <div class="dropdown pull-left" style="margin-right: 1em;">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Rozvrhy<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/schedule-subject') }}">Rozvrhy predmetov</a></li>
                        <li><a href="{{ url('/schedule-staff') }}">Rozrvhy učiteľov</a></li>
                        <li><a href="{{ url('/schedule-rooms') }}">Rozvrhy miestností</a></li>
                        <li><a href="{{ url('/schedule-days') }}">Rozvrhy dňa v týždni</a></li>
                        <li><a href="{{ url('/schedule-departments') }}">Rozvrhy oddelení</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="intra-div">
            <form class="form-horizontal" method="GET" action="{{ url('/schedule-departments') }}">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="select">Oddelenie</label>
                        <select class="form-control" id="select" name="department">
                            @foreach ($all_departments as $d) 
                                <option value="{{ $d->department }}" @if($department) @if($d->department == $department) {{ 'selected' }} @endif @endif>{{ $d->department }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-md-offset-1">
                    <div class="form-group">
                        <label for="select">Rok</label>                      
                        <select class="form-control" id="select" name="year">
                            @foreach ($other_years_db as $y) 
                                <option value="{{ $y->year }}" @if($y->year == $year->year) {{ 'selected' }} @endif>{{ $y->year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-md-offset-1 ">
                    <div class="form-group">
                        <label for="select">Semester</label>                      
                        <select class="form-control" id="select" name="semester">
                            @foreach ($seasons as $s) 
                                <option value="{{ $s->semester }}" @if($s->semester == $semester) {{ 'selected' }} @endif>@if($s->semester == 0){{ 'Zimný' }}@else{{ 'Letný' }}@endif</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Zobraz</button>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            <label><input type="checkbox" name="voidDays" @if($all_days) {{ 'checked' }} @endif>Zobraz prázdne dni</label>
                        </div>
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
                                <td colspan="@if(is_array($sd[$i+7])) {{ $sd[$i+7]['duration'] }} @endif" class="text-center" style="width: 5%;background-color:@if(is_array($sd[$i+7])) {{ $sd[$i+7]['color'] }} @endif">
                                    @if(is_array($sd[$i+7]))
                                        {{ $sd[$i+7]['subject'] }}
                                        @php
                                            
                                            $i += ($sd[$i+7]['duration'] - 1);
                                        @endphp
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
        @endif


    </div>
</div>
<script>
    $(document).ready(function(){
        $('#schedule_table').fadeIn("slow");
    });

</script>
@stop