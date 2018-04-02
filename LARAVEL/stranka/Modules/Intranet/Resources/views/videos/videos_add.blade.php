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
                        <a href="{{ url('/videos-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Pridanie Videa</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/videos-admin-add-action') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="tzpe">* Kategória:</label>
                            <select class="form-control" id="type" name="type" >
                                @foreach($types as $key => $t)
                                    <option value="{{ $key }}">{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="title_sk">* Slovenský nadpis:</label>
                            <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="url">* YouTube ID:</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="GM9Bfmmo1QE pre https://www.youtube.com/watch?v=GM9Bfmmo1QE" required />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="title_en">* Anglický nadpis:</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" required />
                        </div>
                    </div>
                </div>
               
                <input type="submit" class="btn btn-success pull-right" value="Pridaj" />
            </form>
            
		</div>
	</div>

</div> 
@stop