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
            Pridanie školského roka
        </h3>
        <div class="intra-div">
            <form class="form-horizontal" method="POST" action="{{ url('/schedule-admin-add-school-year-action') }}">
                {{ csrf_field() }}
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" name="year" id="year" class="form-control" placeholder="Školský rok ( XXXX/YYYY )" />
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary btn-block" value="Ulož" />
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3>
            Aktivuj obdobie
        </h3>
        <div class="intra-div">
            <div class="table-responsive">
                <form method="POST" action="{{ url('/schedule-admin-activate-season') }}">
                    {{ csrf_field() }}
                    <div class="col-md-5">
                        <div class="form-group">
                            <select class="form-control" id="year" name="year">
                            @foreach($years as $y)
                                <option value="{{ $y->year }}" @if($y->year == $active_year->year) {{ 'selected' }}@endif>{{ $y->year }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <select class="form-control" id="season" name="season">
                                <option value="0" @if($active_year->semester == 0) {{ 'selected' }}@endif>Zimný</option>
                                <option value="1" @if($active_year->semester == 1) {{ 'selected' }}@endif>Letný</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-primary btn-block" value="Ulož">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop