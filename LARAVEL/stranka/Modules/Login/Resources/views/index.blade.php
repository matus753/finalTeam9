@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/login.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container login">
	@if(isLogged())
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				<h1>@lang('login::index.logout')</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form method="POST" action="{{ url('/logout-action') }}" class="login-form">
				{{ csrf_field() }}
				<input type="submit" class="btn btn-primary login-input" value="@lang('login::index.to_logout')">
			</form>
		</div>
	</div>

	@else
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				<h1>@lang('login::index.login')</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<form method="POST" action="{{ url('/login-action') }}"   class="login-form">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="name">@lang('login::index.name'):</label>
					<input type="text" class="form-control" id="name" name="name" />
				</div>
				<div class="form-group">
					<label for="pass">@lang('login::index.pass'):</label>
					<input type="password" class="form-control" id="pass" name="pass" />
				</div>
				<input type="submit" class="btn btn-primary login-input" value="@lang('login::index.to_login')">
			</form>
		</div>
	</div>
	@endif
</div>
@stop
