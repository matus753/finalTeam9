@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content_admin')
<style>
	.pn{
		background-color: #ffb861;
	}
	.d{
		background-color: #00cdcd;
	}
	.pd{
		background-color: #cd0000;
	}
	.nl{
		background-color: #c6fd06;
	}
	.ho{
		background-color: #70a78f;
	}
</style>

<div id="emPAGEcontent" class="container">
<br><br>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<select id="year" class="form-control">
					@foreach($years as $y)
						<option value="{{ $y }}" @if($y == $curr_year) {{ 'selected' }} @endif>{{ $y }}</option> 
					@endforeach
				</select>
			</div>
			<div class="col-md-4">
				<select id="month" class="form-control">
					@for($i = 1; $i < 13; $i++)
						<option value="{{ $i }}" @if($i == $curr_month) {{ 'selected' }} @endif>{{ $i }}</option> 
					@endfor
				</select>
			</div>
			<div class="col-md-4">
				<input class="form-control" type="text" id="searchbox" placeholder="Search name ...">
			</div>
		</div>
	</div>
	<hr>
	<label class="radio-inline" style="background-color: white;"><input type="radio" name="absence" id="-1" value="" checked>Delete</label>
	@foreach($absence as $a)
		<label class="radio-inline" style="background-color: {{ $a->farba }};"><input type="radio" name="absence" id="{{ $a->t_id }} " value="{{ $a->skratka }}" >{{ $a->nazov }}</label>
	@endforeach
	<hr>
	<div class="row">
		<div class="col-md-12">
			<div class="text-center" id="rdata" >	
				<div class="table-responsive">
					<table id="attendance" class="table table-bordered">
						<thead>
							<tr>
								<th>Meno</th>
								@for($i = 1; $i < $num_days+1; $i++ )
									<th>{{ $i }}</th>
								@endfor
							</tr>
						</thead>
						<tbody>
							@foreach($staff as $ks => $s)
								<tr id="{{ $s->s_id }}" >
									<td>{{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }}&nbsp;</td>
									@for($i = 1; $i < $num_days+1; $i++ )
										@if(date('N',strtotime($curr_year.'-'.$curr_month.'-'.$i)) >= 6)
											<td id="{{ $s->s_id }}" data-date-day="{{ $i }}" style="background-color: lightgray;"></td>
										@else
											@if(isset($s->att['skratky'][$i]))
												<td id="{{ $s->s_id }}" data-date-day="{{ $i }}" class="{{ $s->att['skratky'][$i] }}" >{{ strtoupper($s->att['skratky'][$i]) }}</td>
											@else
												<td id="{{ $s->s_id }}" data-date-day="{{ $i }}"></td>
											@endif
										@endif
									@endfor
								</tr>
							@endforeach
						</tbody>
						<tfoot>						
							<tr>
								<th>Meno</th>
								@for($i = 1; $i < $num_days+1; $i++ )
									<th>{{ $i }}</th>
								@endfor
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>   
<script>
	var year;
	var month;

	$('#year').on('change', function(){
		year = $('#year').val();
		month = $('#month').val();
		window.location = "{{ url('/attendance-admin') }}/" + year + "/" + month;
	});

	$('#month').on('change', function(){
		year = $('#year').val();
		month = $('#month').val();
		window.location = "{{ url('/attendance-admin') }}/" + year + "/" + month;
	});
	
	$('#searchbox').on('keyup', function(){
		var val = $(this).val().toUpperCase();

		$('#attendance').find('tr').each(function(i){
			if(i === 0) return;
			var name = $(this).find('td').first().text().toUpperCase();
			$(this).toggle(name.indexOf(val) !== -1)		
		});
	});

	$(function () {
		var isMouseDown = false;
		$("#attendance td")
			.mousedown(function () {
				var staff = $(this).parent().attr('id');
				var day = $(this).data('dateDay');
				year = $('#year').val();
				month = $('#month').val();
				var type = $('input[name=absence]:checked').attr('id');
				var data = {
					'staff' : staff,
					'year'	: year,
					'month'	: month,
					'day'	: day,
					'type'	: type
				};
				isMouseDown = true;
				if($(this).text().length == 0 || $(this).text().trim() != $('input[name=absence]:checked').val()){
					if($(this).data('dateDay')){
						$(this).empty()
						$(this).removeClass();
						$(this).append($('input[name=absence]:checked').val());
						$(this).toggleClass($('input[name=absence]:checked').val().toLowerCase());
						sendData(data);
					}
				}
				return false;
			})
			.mouseover(function () {
				if (isMouseDown) {
					var staff = $(this).parent().attr('id');
					year = $('#year').val();
					month = $('#month').val();
					var day = $(this).data('dateDay');
					var type = $('input[name=absence]:checked').attr('id');
					var data = {
						'staff' : staff,
						'year'	: year,
						'month'	: month,
						'day'	: day,
						'type'	: type
					};
					if($(this).text().length == 0 || $(this).text().trim() != $('input[name=absence]:checked').val()){
						if($(this).data('dateDay')){
							$(this).empty();
							$(this).removeClass();
							$(this).append($('input[name=absence]:checked').val());  
							$(this).toggleClass($('input[name=absence]:checked').val().toLowerCase());
							sendData(data);
						}
					}
				}
		});
		
		$('#attendance td').mouseup(function () {
			isMouseDown = false;
		});
	});
	
	function sendData(data){
		$.ajax({
			url : '{{ url("/attendance-admin-ajax") }}',
			data : data,
			headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
		}).fail(function(data){
			console.log(JSON.parse(data));
		});
	}
</script>
@stop
