@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content')
<script>
$(document).ready(function() {
    $('#staff').DataTable( {
    	"pageLength": 50,
    	"columns": [
		    { "width": "28%" },
		    null,
		    null,
		    null,
		    null,
		    null
		  ]
    });
    $('.staff__table-row').on("click",function(){
        window.location = $(this).data('href');
        return false;
    });
} )
</script>

<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner1.jpg') }}')">
	<h1>Pracovníci</h1>
</section>
<section class="staff">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="table table-responsive">
					<table id="staff" class="staff__table">
						<thead>
							<tr class="staff__table-title">
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
							<tr class="staff__table-row" data-href="<?php echo e(URL::asset('/staff/' . $s->id)); ?>">
								<td><i class="fa fa-search-plus" ></i>&nbsp;&nbsp;&nbsp;{{ $s->title1 }} {{ $s->name }} {{ $s->surname }} @if($s->title2) ,{{ $s->title2 }} @endif</td>
								<td>{{ $s->room }}</td>
								<td>{{ $s->phone }}</td>
								<td>{{ $s->department }}</td>
								<td>{{ $s->staffRole }}</td>
								<td>{{ $s->function }}</td>						
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr class="staff__table-title">
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
</section>

@stop
