@extends('base_structure')

@section('content')
<div id="emPAGEcontent">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>Pracovníci</h1>
			<hr>
			<h2>Filter pre oddelenia a zaradenia:</h2>
			<div class="form-inline staff-filter">
				<div class='row'> 
					<div class='col-md-3'></div>
					<div class="col-md-3 col-xs-6">
						<input type="text" id="SS-filterDep" onkeyup="filterDepartment()" placeholder="Filter oddelení.." title="Zadajte oddelenie" class="form-control mb-2 mr-sm-2 mb-sm-0">
					</div>
					<div class="col-md-3 col-xs-6">
						<input type="text" id="SS-filterRole" onkeyup="filterRole()" placeholder="Filter zaradenia.." title="Zadajte zaradenie" class="form-control mb-2 mr-sm-2 mb-sm-0">
					</div>
					<div class='col-md-3'></div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
