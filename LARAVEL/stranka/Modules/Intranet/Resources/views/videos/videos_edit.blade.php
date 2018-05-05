@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content_admin')
<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left" style="margin-top: 20px">
                        <a href="{{ url('/videos-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Editácia videa</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/videos-admin-edit-action/'.$video->v_id) }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="tzpe">* Kategória:</label>
                            <select class="form-control" id="type" name="type" >
                                @foreach($types as $key => $t)
                                    <option value="{{ $key }}" @if($key == $video->type) {{ 'selected' }} @endif>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="title_sk">Slovenský nadpis:</label>
                            <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" value="{{ $video->title_SK }}" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="url">YouTube ID:</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="{{ $video->url }}" required />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="title_en">Anglický nadpis:</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" value="{{ $video->title_EN }}" required />
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Uložiť" />
            </form>
		</div>
	</div>

</div>   
@stop