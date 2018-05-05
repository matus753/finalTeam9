@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/bootstrap-select.js') }}"></script>
<link href="{{ URL::asset('css/bootstrap-select.css') }}" rel="stylesheet">
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
            <form method="GET" action="{{ url('/schedule-staff') }}">
                <div class="form-group">
                    <label for="select">Zamestnanci</label>
                    <select class="form-control selectpicker" data-live-search="true" multiple id="select" name="staff[]">
                        @foreach ($all_staff as $s) 
                            <option value="{{ $s->s_id }}" data-tokens="{{ $s->title1 }} {{ $s->name }} {{ $s->surname }} {{ $s->title2 }}" @if(count($selected_staff) > 0) @foreach($selected_staff as $ss ) @if($s->s_id == $ss) {{ 'selected' }} @endif @endforeach @endif>{{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
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
                                <td colspan="@if(is_array($sd[$i+7])) {{ $sd[$i+7]['duration'] }} @endif" class="text-center" style="width: 5%;background-color:@if(is_array($sd[$i+7])) {{ $sd[$i+7]['color'] }} @endif">
                                    @if(is_array($sd[$i+7]))
                                        <p>{{ $sd[$i+7]['abb'] }}</p>
                                        <p>{{ $sd[$i+7]['room'] }}</p>
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
        <div class="row">
                <div class="col-md-12">
                    @foreach($subject_assignment as $sub)
                        @foreach($sub as $ss)
                            @foreach($all_staff as $as)
                                @if($ss->s_id == $as->s_id)
                                <h4>{{ $as->title1 }}&nbsp;{{ $as->name }}&nbsp;{{ $as->surname }}&nbsp;{{ $as->title2 }} <small>{{ $ss->title }}</small></h4>
                                
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