@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

@stop
@section('content_admin')

<div class="container">
    <div class="row">
        <div class="intra-div">
            <div class="pull-left">
                <a href="{{ url('/documents-admin') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>ÚAMT Rozvrhy <small>- konzultácie</small></h2>
        </div>
    </div>
    <hr>
    <form action="{{ url('/schedule-admin-consultations-action') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    <h4>Začiatok konzultácie:</h4>
                </div>
                <div class="col-md-2">
                    <select name="add_start_time" class="form-control">
                        @for($i = 0;$i < 13; $i++ )
                            @for($j = 0;$j < 60; $j+=15)
                                <option value="{{ ($i+7) }}: @if($j == 0) {{ $j.'0' }} @else {{ $j }} @endif">{{ ($i+7) }}: @if($j == 0) {{ $j.'0' }} @else {{ $j }} @endif</option>
                            @endfor
                        @endfor
                    </select>
                </div>
                <div class="col-md-1">
                    <h4>Názov:</h4>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="add_name" placeholder="Názov konzultácie" required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    <h4>Koniec konzultácie:</h4>
                </div>
                <div class="col-md-2">
                    <select name="add_end_time" class="form-control">
                        @for($i = 0;$i < 13; $i++ )
                            @for($j = 0;$j < 60; $j+=15)
                                <option value="{{ ($i+7) }}:@if($j == 0){{ $j.'0' }}@else{{ $j }}@endif">{{ ($i+7) }}: @if($j == 0) {{ $j.'0' }} @else {{ $j }} @endif</option>
                            @endfor
                        @endfor
                    </select>
                </div>
                <div class="col-md-1">
                    <h4>Konzultanti:</h4>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="add_cons" placeholder="Konzultanti" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    <h4>Deň konzultácie:</h4>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="add_day" id="add_day">
                        @foreach($day_names as $key => $dn)
                            <option value="{{ $key }}">{{ $dn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 col-md-offset-6">
                    <input type="submit" class="btn btn-success btn-block" value="Pridaj"/>
                </div>
            </div>
        </div>
    </form>
    <br>
    @if(count($schedule_data))
    <div class="row" id="schedule_table" style="display: none;">
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
                                    {{ $sd[$i+7]['room'] }}
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
    <hr>
    @if($consultations)
        <div class="row" id="cons_table" style="display: none;">
            
            @foreach($consultations as $c)
            <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="{{ $c->c_id }}" class="table table-bordered">
                            <tr>
                                <th colspan="3">Názov konzultácie: {{ $c->name }}</th>
                                <th>
                                    <a href="{{ url('/schedule-admin-delete-cons/'.$c->c_id) }}" class="btn btn-danger"><span class="fa fa-trash-o"></span></a>
                                </th>
                            </tr>
                            <tr>
                                <td>Začiatok</td>
                                <td>{{ $c->start_time }}</td>
                                <td>
                                    <select id="update_end_time" class="form-control">
                                        @for($i = 0;$i < 13; $i++ )
                                            @for($j = 0;$j < 60; $j+=15)
                                                <option value="{{ ($i+7) }}:@if($j == 0){{ $j.'0' }}@else{{ $j }}@endif">{{ ($i+7) }}: @if($j == 0) {{ $j.'0' }} @else {{ $j }} @endif</option>
                                            @endfor
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                    <button onclick="update_start_time({{$c->c_id}})" class="btn btn-success"><span class="fa fa-check"></span></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Koniec</td>
                                <td>{{ $c->end_time }}</td>
                                <td>
                                    <select id="update_end_time" class="form-control">
                                        @for($i = 0;$i < 13; $i++ )
                                            @for($j = 0;$j < 60; $j+=15)
                                                <option value="{{ ($i+7) }}:@if($j == 0){{ $j.'0' }}@else{{ $j }}@endif">{{ ($i+7) }}: @if($j == 0) {{ $j.'0' }} @else {{ $j }} @endif</option>
                                            @endfor
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                    <button onclick="update_endt_time({{$c->c_id}})" class="btn btn-success"><span class="fa fa-check"></span></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Konzultanti</td>
                                <td>{{ $c->consultants }}</td>
                                <td>
                                    <input type="text" class="form-control" id="update_consults" placeholder="Hodnoty budú nahradené..."/>
                                </td>
                                <td>
                                    <button onclick="update_consultants({{$c->c_id}})" class="btn btn-success"><span class="fa fa-check"></span></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach
    </div>
    @endif
</div>
<script>
    $(document).ready(function(){
        $('#schedule_table').fadeIn("slow");
        $('#cons_table').fadeIn("slow");
    });


</script>
@stop