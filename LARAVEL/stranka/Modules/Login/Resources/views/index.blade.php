@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div id="emPAGEcontent" class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				<h1>Prihlásenie</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<form method="POST" action="{{ url('/login-action') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" class="form-control" id="name" name="name" />
				</div>
				<div class="form-group">
					<label for="pass">Heslo:</label>
					<input type="password" class="form-control" id="pass" name="pass" />
				</div>
				<input type="submit" class="btn btn-primary" value="Prihlás">
			</form>
		</div>
	</div>
</div>
@stop
