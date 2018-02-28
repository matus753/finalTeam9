@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content')
<section class="banner banner--big" style="background-image: url('{{ URL::asset('images/banners/banner2.jpg') }}')">

</section>
<section class="staff-profile">
	<div class="container">
		<div class="staff-profile__content">
			<div class="staff-profile__info">
				<div class="row">
					@if( $ais->photo )
					<div class="col-sm-4 staff-profile__img">
						<img src="{{ get_profile_photo($ais->photo) }}" alt="{{ $ais->photo }}">
					</div>
					<div class="col-sm-offset-1 col-sm-7">
					@else
					<div class="col-sm-offset-2 col-sm-8">
					@endif					
						<a href="{{ url('/staff-admin') }}" class="staff-profile__back"><i class="fa fa-arrow-left"></i>@lang('staff::staff.back')</a>
						<h2>{{ $ais->title1 }} {{ $ais->name }} <b>{{ $ais->surname }}</b>, {{ $ais->title2 }}</h2>
						<span class="staff-profile__role">{{ $ais->staffRole }}</span>
						<hr>
						<div class="staff-profile__description">
							<p><span>@lang('staff::staff.room'): </span>{{ $ais->room }}</p>
							<p><span>@lang('staff::staff.phone'): </span>+421 60291 {{ $ais->phone }}</p>
							<p><span>@lang('staff::staff.department'): </span>{{ $ais->department }}</p>
							@if( $ais->function ) 
								<p><span>@lang('staff::staff.function'): </span>{{ $ais->function }}</p>
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="staff-profile__contact">
				<div class="staff-profile__links">
					<?php 
						if (empty($ais->email)) { 
							$staffEmail = $ais->name . "." . $ais->surname . "@stuba.sk";
						} 
						else {
							$staffEmail = $ais->email;
						}
						/*$staffEmail = remove_accents($staffEmail);
						$staffEmail = strtolower($staffEmail);*/
					?>
					<a href="mailto:{{ $staffEmail }}"><i class="fa fa-envelope" aria-hidden="true"></i> {{ $staffEmail }}</a>
					@if( $ais->web ) 
					<a href="{{ $ais->web }}" target="_blank"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{ $ais->web }}</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
@stop
