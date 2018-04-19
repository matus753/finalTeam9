@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content_admin')
<div id="emPAGEcontent" class="container">
    <div class="intra-div">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="pull-left">
                    <a href="{{ url('/documents-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                </div>
                <h2>Editácia kategórie: {{ $item->name_sk }}</h2>
            </div>
        </div>

        <form action="{{ url('/documents-admin-edit-category-action/'.$item->dc_id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="title_sk">Slovenský nadpis:</label>
                        <input type="text" class="form-control" id="title_sk" name="title_sk" value="{{ $item->name_sk }}" placeholder="Slovenský nadpis" required />
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="title_en">Anglický nadpis:</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $item->name_en }}" placeholder="Anglický nadpis" required />
                    </div>
                </div>
                <div class="row text-center lastButton">
                    <input type="submit" class="btn btn-success" value="Ulož" />
                </div>
            </div>
        </form>
    </div>
</div>
@stop