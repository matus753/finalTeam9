@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content')
<script>
var table_pubs;
var table_content;

function showPubs(){
	var data = { 'ais_id' : {{ $ais_id }} };
	$.ajax({
		url:"{{ url('/staff/ajax_publications') }}", 
		type: 'POST' , 
		data : data, 
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success : function(data){
			var jsonObject = JSON.parse(data);
			if(data){
				$('#publications_table').removeClass('hidden');
			}
			$('#publications_table').DataTable({
				data: jsonObject,
				columns : [
						{"data" : "content"},
						{"data" : "type"},
						{"data" : "year"}        
				]
			});
		}
	});
}

</script>
<section class="banner banner--big" style="background-image: url('{{ URL::asset('images/banners/banner2.jpg') }}')">

</section>
<section class="staff-profile">
	<div class="container">
		<div class="staff-profile__content">
			<div class="staff-profile__info">
				<div class="row">
					<div class="col-sm-4 staff-profile__img">
						<img src="{{ URL::asset('images/staffPhoto') }}/{{ $ais->photo }}" alt="{{ $ais->photo }}">
					</div>
					<div class="col-sm-offset-1 col-sm-7">
						<a href="{{ url('/staff') }}" class="staff-profile__back"><i class="fa fa-arrow-left"></i>@lang('staff::staff.back')</a>
						<h2>{{ $ais->title1 }} {{ $ais->name }} <b>{{ $ais->surname }}</b>, {{ $ais->title2 }}</h2>
						<span class="staff-profile__role">{{ $ais->staffRole }}</span>
						<hr>
						<div class="staff-profile__description">
							<p><span>@lang('staff::staff.room'): </span>{{ $ais->room }}</p>
							<p><span>@lang('staff::staff.phone'): </span>+421 60291 {{ $ais->phone }}</p>
							<p><span>@lang('staff::staff.department'): </span>{{ $ais->department }}</p>
							<p><span>@lang('staff::staff.function'): </span>{{ $ais->function }}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="staff-profile__contact">
				<div class="staff-profile__links">
					<a href=""><i class="fa fa-envelope" aria-hidden="true"></i></a>
					<a href=""><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="staff-publications">
	<div class="staff-publications__button">
		@if( $ais->ldapLogin )
		<button onclick="showPubs()" >@lang('staff::staff.show_publications')</button>
		@else
		<br>
		@endif
	</div>
</section>

<section class="staff"  >
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="publications_table" class="table table-stripped table-bordered hidden" id="staff">
						<thead>
							<tr>
								<th>@lang('staff::staff.tbl-title')</th>
								<th>@lang('staff::staff.type')</th>
								<th>@lang('staff::staff.year')</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@stop
