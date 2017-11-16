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
			<div class="table table-responsive">
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
						@foreach($staff as $s)
						<tr>
							<td><a href="/staff/{{ $s->id }}" ><i class="fa fa-search-plus" ></i></a>&nbsp;&nbsp;&nbsp;{{ $s->title1 }} {{ $s->name }} {{ $s->surname }} @if($s->title2) ,{{ $s->title2 }} @endif</td>
							<th>{{ $s->room }}</th>
							<th>{{ $s->phone }}</th>
							<th>{{ $s->department }}</th>
							<th>{{ $s->staffRole }}</th>
							<th>{{ $s->function }}</th>						
						</tr>
						@endforeach
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
