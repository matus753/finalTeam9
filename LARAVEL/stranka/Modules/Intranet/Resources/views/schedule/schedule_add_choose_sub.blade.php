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
                <a href="{{ url('/schedule-admin-subject') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>ÚAMT Rozvrhy</h2>
        </div>
        <hr>
        <h3>
            Pridanie rozvrhu pre šk. rok {{ $active_year->year }}, semester @if($active_year->semester == 'zimny') {{ 'zimný' }} @else {{ 'letný' }} @endif
        </h3>
    </div>
    <hr>
    <div class="row">
        <h4>
            Predmety bez rozvrhu
        </h4>
        <div class="intra-div">
            <form method="POST" action="{{ url('/schedule-admin-add') }}">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="col-md-10">
                        <div class="group-form">
                            <select class="form-control" id="subjects" name="sub">
                                @foreach($subjects_without_schedule as $s)
                                    <option value="{{ $s->sub_id }} ">{{ $s->title }}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div> 
                    <div class="col-md-2">            
                        <input type="submit" class="btn btn-primary" value="Vyber">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <h4>
            Predmety s rozvrhom
        </h4>
        <div class="intra-div">
            <form method="POST" action="{{ url('/schedule-admin-add') }}">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="col-md-10">
                        <div class="group-form">
                            <select class="form-control" id="subjects" name="sub">
                                @foreach($subjects_with_schedule as $s)
                                    <option value="{{ $s->sub_id }} ">{{ $s->title }}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div> 
                    <div class="col-md-2">            
                        <input type="submit" class="btn btn-primary" value="Vyber">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop