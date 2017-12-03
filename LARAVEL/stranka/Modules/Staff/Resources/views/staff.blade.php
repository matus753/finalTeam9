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
		  ],
		"language": {
		    "sEmptyTable":     "@lang('staff::staff.sEmptyTable')",
		    "sInfo":           "@lang('staff::staff.sInfo')",
		    "sInfoEmpty":      "@lang('staff::staff.sInfoEmpty')",
		    "sInfoFiltered":   "@lang('staff::staff.sInfoFiltered')",
		    "sInfoPostFix":    "@lang('staff::staff.sInfoPostFix')",
		    "sInfoThousands":  "@lang('staff::staff.sInfoThousands')",
		    "sLengthMenu":     "@lang('staff::staff.sLengthMenu')",
		    "sLoadingRecords": "@lang('staff::staff.sLoadingRecords')",
		    "sProcessing":     "@lang('staff::staff.sProcessing')",
		    "sSearch":         "@lang('staff::staff.sSearch')",
		    "sZeroRecords":    "@lang('staff::staff.sZeroRecords')",
		    "oPaginate": {
		        "sFirst":    "@lang('staff::staff.sFirst')",
		        "sLast":     "@lang('staff::staff.sLast')",
		        "sNext":     "@lang('staff::staff.sNext')",
		        "sPrevious": "@lang('staff::staff.sPrevious')"
		    },
		    "oAria": {
		        "sSortAscending":  "@lang('staff::staff.sSortAscending')",
		        "sSortDescending": "@lang('staff::staff.sSortDescending')"
		    }
		}
    });
    $('.staff__table-row').on("click",function(){
        window.location = $(this).data('href');
        return false;
    });
} )
</script>

<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner1.jpg') }}')">
	<h1>@lang('staff::staff.title')</h1>
</section>
<section class="staff">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="table table-responsive">
					<table id="staff" class="staff__table">
						<thead>
							<tr class="staff__table-title">
								<th>@lang('staff::staff.name')</th>
								<th>@lang('staff::staff.room')</th>
								<th>@lang('staff::staff.phone') +421&nbsp;60291&nbsp;xxx</th>
								<th>@lang('staff::staff.department')</th>
								<th>@lang('staff::staff.role')</th>
								<th>@lang('staff::staff.function')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($staff as $s)
							<tr class="staff__table-row" data-href="{{ url('/staff') }}/{{ $s->id }}">
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
								<th>@lang('staff::staff.name')</th>
								<th>@lang('staff::staff.room')</th>
								<th>@lang('staff::staff.phone')</th>
								<th>@lang('staff::staff.department')</th>
								<th>@lang('staff::staff.role')</th>
								<th>@lang('staff::staff.function')</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@stop
