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
<div id="emPAGEcontent">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
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
</div>

@stop
