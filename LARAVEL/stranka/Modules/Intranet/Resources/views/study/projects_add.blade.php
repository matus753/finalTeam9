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
                    <div class="pull-left">
                        <a href="{{ url('/projects-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Pridanie nového projektu</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/projects-admin-add-action') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <select class="form-control" name="type">
                        @foreach($types as $t)
                            <option value="{{ $t }}">{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_number">ID číslo:</label>
                    <input type="text" class="form-control" id="id_number" name="id_number" placeholder="ID číslo" required />
                </div>
                <div class="form-group">
                    <label for="title_sk">Slovenský nadpis:</label>
                    <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" required />
                </div>
                <div class="form-group">
                    <label for="title_en">Anglický nadpis:</label>
                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" required />
                </div>
                zmenit na  date ?
                <div class="form-group">
                    <label for="duration">Trvanie:</label>
                    <input type="text" class="form-control" id="duration" name="duration" placeholder="Trvanie" required />
                </div>
                prepojiť so staff ?
                <div class="form-group">
                    <label for="coordinator">Koordinátor:</label>
                    <input type="text" class="form-control" id="coordinator" name="coordinator" placeholder="Koordinátor" required />
                </div>
                <div class="form-group">
                    <label for="partners">Partneri:</label>
                    <input type="text" class="form-control" id="partners" name="partners" placeholder="Partneri" />
                </div>
                <div class="form-group">
                    <label for="web">Web:</label>
                    <input type="text" class="form-control" id="web" name="web" placeholder="Web" />
                </div>
                <div class="form-group">
                    <label for="iCode">Kód:</label>
                    <input type="text" class="form-control" id="iCode" name="iCode" placeholder="Kód" required />
                </div>
                <div class="form-group">
                    <label for="annotationSK">Slovenská anotácia:</label>
                    <textarea rows="8" class="form-control" id="annotationSK"  name="annotationSK"></textarea>
                </div>
                <div class="form-group">
                    <label for="annotationEN">Anglická anotácia:</label>
                    <textarea rows="8" class="form-control" id="annotationEN" name="annotationEN"></textarea>
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Pridaj" />
            </form>
		</div>
	</div>

</div>   
@stop