@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content_admin')

<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('/events-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Pridanie novej udalosti</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/events-admin-add-action') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title_sk">Slovenský nadpis:</label>
                    <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" required />
                </div>
                <div class="form-group">
                    <label for="title_en">Anglický nadpis:</label>
                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" required />
                </div>
                <div class="form-group">
                    <label for="sk_text">SK text:</label>
                    <input type="text" class="form-control" id="sk_text" name="sk_text" placeholder="SK text" required />
                </div>
                <div class="form-group">
                    <label for="en_text">EN text:</label>
                    <input type="text" class="form-control" id="en_text" name="en_text" placeholder="EN text" required />
                </div>
                <div class="form-group">
                    <label for="place">Miesto:</label>
                    <input type="text" class="form-control" id="place" name="place" placeholder="place" required />
                </div>
                <div class="form-group">
                    <label for="date">Dátum:</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Datum" />
                </div>
                cas staci ako text ci type time ?
                <div class="form-group">
                    <label for="time">Cas:</label>
                    <input type="text" class="form-control" id="time" name="time" placeholder="Time" />
                </div>
                <div class="form-group">
                    <label for="link">Link:</label>
                    <input type="text" class="form-control" id="link" name="link" placeholder="Link" />
                </div>
                <div class="form-group">
                    <label for="file">Obrazok:</label>
                    <input type="file" class="form-control" id="file" name="file" placeholder="Súbor"/>
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Pridaj" />
            </form>
		</div>
	</div>

</div>   
@stop