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
                <a href="{{ url('/schedule-admin-add-choose') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>ÚAMT Rozvrhy</h2>
        </div>
        <hr>
        <h3>
            Pridanie rozvrhu pre šk. rok {{ $active_year->year }} k predmetu {{ $subject->title }}
        </h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <label for="type">Typ hodiny</label>
                <select class="form-control" name="type" id="type" >
                    <option value="prednaska">Prednáška</option>
                    <option value="cvicenie">Cvičenie</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="type">Výber miestnosti</label>
                <select class="form-control" name="room" id="room">
                    @foreach($rooms as $r)
                        <option value="{{ $r->sr_id }}">{{ $r->room }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <h5>Trvanie prednášky: {{ $subject->duration_p }}</h5>
            </div>
            <div class="col-md-2">
                <h5>Trvanie cvičenia: {{ $subject->duration_c }}</h5>
            </div>
            <div class="col-md-2">
                <a href="{{ url('/subjects-admin-edit-info-item/'.$subject->sub_id) }}" class="btn btn-success">Zmena trvania</a>
            </div>
            <div class="col-md-6">
                <div class="col-md-3" style="padding-right: 0;">
                    <h5>Začiatok hodiny:</h5>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="start_time" id="start_time">
                    @for($i = 0; $i < 15; $i++)
                        <option value="{{ $i+7 }}">{{ $i+7 }}:00</option>
                    @endfor
                    </select>
                </div>
                <div class="col-md-3" style="padding-right: 0;">
                    <h5>Deň v týždni:</h5>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="day" id="day">
                        @foreach($day_names as $key => $dn)
                            <option value="{{ $key }}">{{ $dn }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <button id="add" class="btn btn-success pull-right">Ulož</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div id="prednasky">
                <h4>Prednášky</h4>
                @if(count($prednasky) == 0)
                    <p>Žiadne dáta</p>
                @else
                    <table class="table table-striped table-bordered">
                    <tr>
                        <th>Miestnosť</th>
                        <th>Zmena miestnosti</th>
                        <th>Deň</th>
                        <th>Zmena dňa</th>
                        <th>Začiatok výučby</th>
                        <th>Zmena času</th>
                        <th></th>
                    </tr>
                    @foreach($prednasky as $p)
                    <tr id="{{ $p->l_id }}">
                        <td>{{ $p->room->room }}</td>
                        <td>
                            <select name="new_room" id="new_room" class="form-control">
                                @foreach($rooms as $r)
                                    <option value="{{ $r->sr_id }}" @if($p->room_id == $r->sr_id) {{ 'selected' }} @endif >{{ $r->room }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>{{ $day_names[$p->day] }}</td>
                        <td>
                            <select class="form-control" name="new_day" id="new_day">
                                @foreach($day_names as $key => $dn)
                                    <option value="{{ $key }}">{{ $dn }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>{{ $p->start_time }}:00</td>
                        <td>
                            <select class="form-control" name="new_start_time" id="new_start_time">
                                @for($i = 0; $i < 15; $i++)
                                    <option value="{{ $i+7 }}" @if($p->start_time == ($i+7)) {{ 'selected' }} @endif >{{ $i+7 }}:00</option>
                                @endfor
                            </select>
                        </td>
                        <td>
                            <button onclick="update_lecture({{ $p->l_id }})" class="btn btn-success"><span class="fa fa-check"></span></button>
                            <button onclick="delete_lecture({{ $p->l_id }})" class="btn btn-danger"><span class="fa fa-trash-o"></span></button>
                        </td>
                    </tr>
                    @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="cvicenia">
                <h4>Cvičenia</h4>
                @if(count($cvicenia) == 0)
                    <p>Žiadne dáta</p>
                @else
                    <table class="table table-striped table-bordered">
                    <tr>
                        <th>Miestnosť</th>
                        <th>Zmena miestnosti</th>
                        <th>Deň</th>
                        <th>Zmena dňa</th>
                        <th>Začiatok výučby</th>
                        <th>Zmena času</th>
                        <th></th>
                    </tr>
                    @foreach($cvicenia as $c)
                    <tr id="{{ $c->l_id }}">
                        <td>{{ $c->room->room }}</td>
                        <td>
                            <select name="new_room" id="" class="form-control">
                                @foreach($rooms as $r)
                                    <option value="{{ $r->sr_id }}" @if($c->room_id == $r->sr_id) {{ 'selected' }} @endif>{{ $r->room }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>{{ $day_names[$c->day]  }}</td>
                        <td>
                            <select class="form-control" name="new_day" id="new_day">
                                @foreach($day_names as $key => $dn)
                                    <option value="{{ $key }}">{{ $dn }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>{{ $c->start_time }}:00</td>
                        <td>
                            <select class="form-control" name="new_start_time" id="new_start_time">
                                @for($i = 0; $i < 15; $i++)
                                    <option value="{{ $i+7 }}" @if($c->start_time == ($i+7)) {{ 'selected' }} @endif>{{ $i+7 }}:00</option>
                                @endfor
                            </select>
                        </td>
                        <td>
                            <button onclick="update_lecture({{ $c->l_id }})" class="btn btn-success"><span class="fa fa-check"></span></button>
                            <button onclick="delete_lecture({{ $c->l_id }})" class="btn btn-danger"><span class="fa fa-trash-o"></span></button>
                        </td>
                    </tr>
                    @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button onclick="show_schedule()" class="btn btn-primary pull-right">Zobraz rozvrh</button>
        </div>
    </div>
    <br>
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
</div>

<script>
    function show_schedule(){
        $('#schedule_table').fadeToggle("slow");
    }

    $('#add').on('click', function(){
        var data = { 
            'id' : '{{ $subject->sub_id }}',
            'room' : $('#room').val(),
            'type' : $('#type').val(),
            'start_time' : $('#start_time').val(),
            'duration_c' : '{{ $subject->duration_c }}',
            'duration_p' : '{{ $subject->duration_p }}',
            'day' : $('#day').val(),
        };

        $.ajax({
            url: "{{ url('/schedule-admin-add-action') }}",
            type: "POST",
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        }).done(function(data){
            location.reload();
        });

    });

    function update_lecture(e){
        var data = {
            'item' : e,
            'room' : $('tr#'+e+' td #new_room').val(),
            'start_time': $('tr#'+e+' td #new_start_time').val(),
            'type' : $('#type').val(),
            'duration_c' : '{{ $subject->duration_c }}',
            'duration_p' : '{{ $subject->duration_p }}',
            'day' : $('tr#'+e+' td #new_day').val(),
        };
        
        $.ajax({
            url : "{{ url('/schedule-admin-update-action') }}",
            type: "POST",
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        }).done(function(){
            location.reload();
        });

    }

    function delete_lecture(e){
        var data = {
            'item' : e,
        };
        
        $.ajax({
            url : "{{ url('/schedule-admin-delete') }}",
            type: "POST",
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        }).done(function(){
            location.reload();
        });
    }
</script>

@stop