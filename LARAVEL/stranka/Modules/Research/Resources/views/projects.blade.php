@extends('base_structure')

@section('additional_headers')

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style_projects.css') }}" rel="stylesheet">
@stop

@section('content')

<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner2.jpg') }}')">
	<h1>Projekty</h1>
</section>
<div id="emPAGEcontent" class="container">
    <div class="container">
		<div class="row">
			<div >
				<div class="table-responsive">
					<table class="table table-striped">
						<thead class="category"><tr><th colspan="4">INTERNATIONAL</th></tr></thead>
						<thead>
							<tr class="staff__table-title">
								<th class="column1">Číslo projektu</th>
								<th class="column2">Názov projektu</th>
								<th class="column3">Doba riešenia</th>
								<th class="column4">Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($international as $i)
							<tr data-href="{{ url('/projects') }}/{{ $i->id }}" data-id="{{$i->id}}" class="m" data-toggle="modal" data-target="#myModalProjects">
								<td class="column1">{{ $i->number }}</td>
								<td class="column2">{{ $i->titleSK }}</td>
								<td class="column3">{{ $i->duration }}</td>
								<td class="column4">{{ $i->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">

					<table class="table table-striped">
                        <thead class="category"><tr><th colspan="4">KEGA</th></tr></thead>
						<thead>
							<tr class="staff__table-title">
								<th class="column1">Číslo projektu</th>
								<th class="column2">Názov projektu</th>
								<th class="column3">Doba riešenia</th>
								<th class="column4">Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($kega as $k)
							<tr data-href="{{ url('/projects') }}/{{ $k->id }}" data-id="{{$k->id}}" class="m" data-toggle="modal" data-target="#myModalProjects">
								<td class="column1">{{ $k->number }}</td>
								<td class="column2">{{ $k->titleSK }}</td>
								<td class="column3">{{ $k->duration }}</td>
								<td class="column4">{{ $k->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
                        <thead class="category"><tr><th colspan="4">VEGA</th></tr></thead>
						<thead>
							<tr class="staff__table-title">
								<th class="column1">Číslo projektu</th>
								<th class="column2">Názov projektu</th>
								<th class="column3">Doba riešenia</th>
								<th class="column4">Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($vega as $v)
							<tr data-href="{{ url('/projects') }}/{{ $v->id }}" data-id="{{$v->id}}" class="m" data-toggle="modal" data-target="#myModalProjects">
								<td class="column1">{{ $v->number }}</td>
								<td class="column2">{{ $v->titleSK }}</td>
								<td class="column3">{{ $v->duration }}</td>
								<td class="column4">{{ $v->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">

					<table class="table table-striped">
                        <thead class="category"><tr><th colspan="4">APVV</th></tr></thead>
						<thead>
							<tr class="staff__table-title">
								<th class="column1">Číslo projektu</th>
								<th class="column2">Názov projektu</th>
								<th class="column3">Doba riešenia</th>
								<th class="column4">Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($apvv as $a)
							<tr data-href="{{ url('/projects') }}/{{ $a->id }}" data-id="{{$a->id}}" class="m" data-toggle="modal" data-target="#myModalProjects">
								<td class="column1">{{ $a->number }}</td>
								<td class="column2">{{ $a->titleSK }}</td>
								<td class="column3">{{ $a->duration }}</td>
								<td class="column4">{{ $a->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">

					<table class="table table-striped ">
                        <thead class="category"><tr><th colspan="4">OTHER</th></tr></thead>
						<thead>
							<tr class="staff__table-title">
								<th class="column1">Číslo projektu</th>
								<th class="column2">Názov projektu</th>
								<th class="column3">Doba riešenia</th>
								<th class="column4">Zodpovedný riešiteľ</th>
							</tr>
						</thead>
						<tbody>
							@foreach($other as $o)
							<tr data-href="{{ url('/projects') }}/{{ $o->id }}" data-id="{{$o->id}}" class="m" data-toggle="modal" data-target="#myModalProjects">
								<td class="column1">{{ $o->number }}</td>
								<td class="column2">{{ $o->titleSK }}</td>
								<td class="column3">{{ $o->duration }}</td>
								<td class="column4">{{ $o->coordinator }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	   
	   
</div>

<div class="modal fade" id="myModalProjects" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" id="modalProjects">
                <div class='modal-projects'>
                    <p id="modalTitle" class='modal-project-title grey bold'></p>
                    <hr>
                    <p class='modal-project-subtitle'>Typ projektu</p>
                    <p id="modalType" class='modal-project-text'></p>
                    <hr>
                    <p class='modal-project-subtitle'>Číslo projektu</p>
                    <p id="modalNumber" class='modal-project-text'></p>
                    <hr>
                    <p class='modal-project-subtitle'>Doba trvania</p>
                    <p id="modalDuration" class='modal-project-text'></p>
                    <hr>
                    <p class='modal-project-subtitle'>Vedúci projektu</p>
                    <p id="modalCoordinator" class='modal-project-text'></p>
                    <hr>

                    <div id="modalPartnersDiv" class="defHide">
                    <p class='modal-project-subtitle'>Partneri</p>
                        <p id="modalPartners" class='modal-project-text'></p>
                    <hr>
                    </div>
                    <div id="modalWebDiv" class="defHide">
                    <p class='modal-project-subtitle'>Webová stránka</p>
                        <p id="modalWeb" class='modal-project-text'></p>

                    <hr>
                    </div>
                    <div id="modalCodeDiv" class="defHide">
                    <p class='modal-project-subtitle'>Interný kód</p>
                        <p id="modalCode" class='modal-project-text'></p>
                    <hr>
                    </div>
                     <div id="modalAnotDiv" class="defHide">
                    <p class='modal-project-subtitle'>Anotácia</p>
                         <p id="modalAnot" class='modal-project-text modal-project-annotation'></p>
                         </div>
			</div>
			<!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
		</div>

	</div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/scripty_projects.js') }}" ></script>
@stop