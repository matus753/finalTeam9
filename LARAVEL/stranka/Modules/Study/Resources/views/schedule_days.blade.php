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
            <form class="form-horizontal" method="GET" action="{{ url('/schedule-days') }}">
                
                <div class="form-group">
                    <label for="select">Deň</label>
                    <select class="form-control" id="select" name="day">
                        @foreach ($day_names as $key => $d) 
                            <option value="{{ $key }}" @if($day) @if($key == $day) {{ 'selected' }} @endif @endif>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Zobraz</button>
                    <div class="checkbox" style="display:inline-block; padding-left: 0.5em;">
                        <label><input type="checkbox" name="voidRooms" @if($voidRooms) {{ 'checked' }} @endif>Zobraz prázdne miestnosti</label>
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