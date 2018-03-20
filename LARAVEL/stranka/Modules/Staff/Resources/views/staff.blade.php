@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content')
<script>
$(document).ready(function() {
    var table = $('#staff').DataTable( {
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
		},
		initComplete: function(){
			var roles = 4;
			var dep = 3;
			this.api().columns().every( function (i) {
				if(i == roles){
					var filterbox = $('<label><div id="filterbox" style="margin: 0.5em 20px 0.5em 0.5em"></div></label>').prependTo($('#staff_filter'));
					$('<label>@lang("staff::staff.role")</label>').prependTo($('#staff_filter'));
					var column = this;
					var select = $('<select class="form-control input-sm"><option value="">@lang("staff::staff.no_role")</option></select>')
						.prependTo( $('#filterbox').empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
	 
							column
								.search( val ? '^'+val+'$' : '', true, false )
								.draw();
						} );
					
					
					column.data().unique().sort().each( function ( d, j ) {
						if(d != ''){
							select.append( '<option value="'+d+'">'+d+'</option>' )
						}
					} );
				}
				
				if(i == dep){
					var filterbox = $('<label><div id="filterbox" style="margin: 0.5em 20px 0.5em 0.5em"></div></label>').prependTo($('#staff_filter'));
					$('<label>@lang("staff::staff.department")</label>').prependTo($('#staff_filter'));
					var column = this;
					var select = $('<select class="form-control input-sm"><option value="">@lang("staff::staff.no_dept")</option></select>')
						.prependTo( $('#filterbox').empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
	 
							column
								.search( val ? '^'+val+'$' : '', true, false )
								.draw();
						} );
					
					
					column.data().unique().sort().each( function ( d, j ) {
						if(d != ''){
							select.append( '<option value="'+d+'">'+d+'</option>' )
						}
					} );
				}
				
            });
		}
    });
    $('.staff__table-row').on("click",function(){
        window.location = $(this).data('href');
        return false;
    });
	
} );
</script>
<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner1.jpg') }}')">
	<h1>@lang('staff::staff.title')</h1>
</section>
<section class="staff">
	<div class="container">
		<div class="row">
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
						<tr class="staff__table-row" data-href="{{ url('/staff') }}/{{ $s->s_id }}">
							<td><i class="fa fa-search-plus" ></i>&nbsp;&nbsp;&nbsp;{{ $s->title1 }} {{ $s->name }} {{ $s->surname }} @if($s->title2) ,{{ $s->title2 }} @endif</td>
							<td>{{ $s->room }}</td>
							<td>{{ $s->phone }}</td>
							<td>{{ $s->department }}</td>
							<td>{{ $s->staffRole }}</td>
							<td>
								@foreach($s->function as $key=>$value)@if($key > 0), @endif{{$value}}@endforeach
							</td>
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
			<div class="staff__notes">
				<h5>@lang('staff::staff.explanatory')</h5> 
				<p><b>@lang('staff::staff.AHU')</b> @lang('staff::staff.AHU_desc')</p>
				<p><b>@lang('staff::staff.OAMM')</b> @lang('staff::staff.OAMM_desc')</p>
				<p><b>@lang('staff::staff.OEAP')</b> @lang('staff::staff.OEAP_desc')</p>
				<p><b>@lang('staff::staff.OEMP')</b> @lang('staff::staff.OEMP_desc')</p>
				<p><b>@lang('staff::staff.OIKR')</b> @lang('staff::staff.OIKR_desc')</p>
			</div>
		</div>
	</div>
</section>

@stop


