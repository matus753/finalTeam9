@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content')
<script>
$(document).ready(function() {
    $('#staff').DataTable();
} )


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
						<a href="{{ url('/staff') }}" class="staff-profile__back"><i class="fa fa-arrow-left"></i>Späť na všetkých zamestnancov</a>
						<h2>{{ $ais->title1 }} {{ $ais->name }} <b>{{ $ais->surname }}</b>, {{ $ais->title2 }}</h2>
						<span class="staff-profile__role">{{ $ais->staffRole }}</span>
						<hr>
						<div class="staff-profile__description">
							<p><span>Kancelária: </span>{{ $ais->room }}</p>
							<p><span>Klapka: </span>{{ $ais->phone }}</p>
							<p><span>Oddelenie: </span>{{ $ais->department }}</p>
							<p><span>Funkcia: </span>{{ $ais->function }}</p>
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
		<button>Zobraziť publikácie</button>
	</div>
</section>
<!-- <div class="container">
	<div class="row">
		<div class="col-lg-12">
		<a href="{{ url('/staff') }}" class="btn btn-default">Späť</a>
		{{ $ais->title1 }}<br>
		{{ $ais->name }}<br>
		{{ $ais->surname }}<br>
		{{ $ais->title2 }}<br>
		do src v img {{ URL::asset('images/staffPhoto') }}/{{ $ais->photo }}<br>
		{{ $ais->room }}<br>
		{{ $ais->phone }}<br>
		{{ $ais->department }}<br>
		{{ $ais->staffRole }}<br>
		{{ $ais->function }}<br>
			<div class="table table-responsive">
				Zmenit na publikacie ked pojde ldap
				<table id="staff" class="table-striped">
					<thead>
						<tr>
							<th>Meno</th>
							<th>Miestnosť</th>
							<th>Klapka</th>
							<th>Oddelenie</th>
							<th>Zaradenie</th>
							<th>Funkcia</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th>Meno</th>
							<th>Miestnosť</th>
							<th>Klapka</th>
							<th>Oddelenie</th>
							<th>Zaradenie</th>
							<th>Funkcia</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div> -->

@stop
