@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content_admin')
<script>
    $(document).ready(function(){
        $('#projects-table').DataTable();  
    });
</script>
<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="pull-right">
                <a href="{{ url('/videos-admin-add') }}" class="btn btn-primary">Pridaj video</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <br>
            <h2>FUNKCIONALITA OK - test + remove bad string. AKTIVACIA POLOZKY ?? </h2>
            <br>
            <br> 
			<div class="text-center">
                <div class="table-responsive">
                    <table id="projects-table" class="table table-stripped table-bordered intranet-table">
                        <thead>
                            <tr class="intranet-table__table-title">
                                <th>Nadpis</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos as $v)
                            <tr>  
                                <td>{{ $v->title }}</td>  
                                <td>{{ $v->type }}</td> 
                                <td>
                                    <a href="{{ url('/videos-admin-edit/'.$v->v_id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil-square-o "></span></a>
                                    <a href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $v->title }} ', '{{ url('/videos-admin-delete/'.$v->v_id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a>
                                </td> 
                            </tr>   
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="intranet-table__table-title">
                                <th>Nadpis</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
			</div>
		</div>
	</div>

</div>   
@stop