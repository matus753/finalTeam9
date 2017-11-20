@extends('base_structure')

@section('additional_headers')

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
@stop

@section('content')
<div id="emPAGEcontent" class="container">
    <div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					TO DO dizajn
					INTERNATIONAL
					<table class="table table-stripped table-bordered">
						<thead>
							<tr class="staff__table-title">
								<th>Číslo projektu</th>
								<th>Názov projektu</th>
								<th>Doba riešenia</th>
								<th>Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($international as $i)
							<tr>
								<td>{{ $i->number }}</td>
								<td>{{ $i->titleSK }}</td>
								<td>{{ $i->duration }}</td>
								<td>{{ $i->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">
					KEGA
					<table class="table table-stripped table-bordered">
						<thead>
							<tr class="staff__table-title">
								<th>Číslo projektu</th>
								<th>Názov projektu</th>
								<th>Doba riešenia</th>
								<th>Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($kega as $k)
							<tr>
								<td>{{ $k->number }}</td>
								<td>{{ $k->titleSK }}</td>
								<td>{{ $k->duration }}</td>
								<td>{{ $k->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">
					VEGA
					<table class="table table-stripped table-bordered">
						<thead>
							<tr class="staff__table-title">
								<th>Číslo projektu</th>
								<th>Názov projektu</th>
								<th>Doba riešenia</th>
								<th>Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($vega as $v)
							<tr>
								<td>{{ $v->number }}</td>
								<td>{{ $v->titleSK }}</td>
								<td>{{ $v->duration }}</td>
								<td>{{ $v->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">
					APVV
					<table class="table table-stripped table-bordered">
						<thead>
							<tr class="staff__table-title">
								<th>Číslo projektu</th>
								<th>Názov projektu</th>
								<th>Doba riešenia</th>
								<th>Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($apvv as $a)
							<tr>
								<td>{{ $a->number }}</td>
								<td>{{ $a->titleSK }}</td>
								<td>{{ $a->duration }}</td>
								<td>{{ $a->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">
					OTHER
					<table class="table table-stripped table-bordered">
						<thead>
							<tr class="staff__table-title">
								<th>Číslo projektu</th>
								<th>Názov projektu</th>
								<th>Doba riešenia</th>
								<th>Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($other as $o)
							<tr>
								<td>{{ $o->number }}</td>
								<td>{{ $o->titleSK }}</td>
								<td>{{ $o->duration }}</td>
								<td>{{ $o->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	   
	   
</div>    
@stop