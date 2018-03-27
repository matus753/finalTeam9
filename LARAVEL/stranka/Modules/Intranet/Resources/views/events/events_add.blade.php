@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content_admin')

<div class="container">
    <div class="staff-intra"> 
        <div class="row">    
            <div class="col-md-10 col-md-offset-1">        
                <div class="pull-left">
                    <a href="{{ url('/events-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                </div>
                <div class="text-center">
                    <h2>Pridanie novej udalosti</h2>
                </div>
            </div>
        </div>
        <form action="{{ url('/events-admin-add-action') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="title_sk">* Slovenský nadpis:</label>
                        <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" required />
                    </div>
                    <div class="form-group">
                        <label for="title_en">* Anglický nadpis:</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" required />
                    </div>
                    <div class="form-group">
                        <label for="sk_text">SK text:</label>
                        <input type="text" class="form-control" id="sk_text" name="sk_text" placeholder="SK text" />
                    </div>
                    <div class="form-group">
                        <label for="en_text">EN text:</label>
                        <input type="text" class="form-control" id="en_text" name="en_text" placeholder="EN text" />
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="place">Miesto:</label>
                        <input type="text" class="form-control" id="place" name="place" placeholder="Miesto" />
                    </div>
                    <div class="form-group">
                        <label for="date">* Dátum:</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Datum" required />
                    </div>
                    <div class="form-group">
                        <label for="time">Čas:</label>
                        <input type="text" class="form-control" id="time" name="time" placeholder="Čas" />
                    </div>
                    <div class="form-group">
                        <label for="link">Link:</label>
                        <input type="text" class="form-control" id="link" name="link" placeholder="Link" />
                    </div>
                </div>
            </div>
            <div class="row">
                <input type="submit" class="btn btn-success text-center staff-intra__add" value="Pridajte udalosť" />
            </div>
        </form>
	</div>
</div>   
@stop