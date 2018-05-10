@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/bootstrap-select.js') }}"></script>
<link href="{{ URL::asset('css/bootstrap-select.css') }}" rel="stylesheet">
@stop
@section('content_admin')

<div class="container">
    <div class="row">
        <div class="intra-div">
            <div class="pull-left">
                <a href="{{ url('/documents-admin') }}" class="btn btn-primary"> Späť </a>
            </div>
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
                        <li><a href="{{ url('/schedule-admin-subject') }}">Rozvrhy predmetov</a></li>
                        <li><a href="{{ url('/schedule-admin-staff') }}">Rozrvhy učiteľov</a></li>
                        <li><a href="{{ url('/schedule-admin-rooms') }}">Rozvrhy miestností</a></li>
                        <li><a href="{{ url('/schedule-admin-days') }}">Rozvrhy dňa v týždni</a></li>
                        <li><a href="{{ url('/schedule-admin-departments') }}">Rozvrhy oddelení</a></li>
                    </ul>
                </div>
            </div>
            @if(has_permission('schedule'))
            <div class="btn-group">
                <div class="dropdown pull-left" style="margin-right: 1em;">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Administrácia<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/schedule-admin-add-choose') }}">Rozvrhy</a></li>
                        <li><a href="{{ url('/schedule-admin-rooms-add') }}">Miestnosti</a></li>
                        <li><a href="{{ url('/schedule-admin-consultations') }}">Konzultácie</a></li>
                        <li><a href="{{ url('/schedule-admin-season') }}">Aktívne obdobie</a></li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <br>
        <div class="intra-div">
            <form class="form-horizontal" method="GET" action="{{ url('/schedule-admin-staff') }}">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="select">Zamestnanci</label>
                        <select class="form-control selectpicker" data-live-search="true" multiple id="select" name="staff[]">
                            @foreach ($all_staff as $s) 
                                <option value="{{ $s->s_id }}" data-tokens="{{ $s->title1 }} {{ $s->name }} {{ $s->surname }} {{ $s->title2 }}" @if(count($selected_staff) > 0) @foreach($selected_staff as $ss ) @if($s->s_id == $ss) {{ 'selected' }} @endif @endforeach @endif>{{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }}</option>
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