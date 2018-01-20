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
                <a href="{{ url('/media-admin-add') }}" class="btn btn-primary">Pridaj médium</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <br>
            <br>
            <br>
            pri delete so soborom delete aj subor ? 
			<div class="text-center">
                <div class="table-responsive">
                    <table id="projects-table" class="table table-stripped table-bordered" >
                        <thead>
                            <tr>
                                <th>Nadpis</th>
                                <th>Typ</th>
                                <th>Zdroj</th>
                                <th>Dátum</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($media as $m)
                            <tr>  
                                <td>{{ $m->title }}</td>  
                                <td>{{ $m->type }}</td>  
                                <td>{{ $m->media }}</td> 
                                <td>{{ $m->date }}</td> 
                                <td>
                                    <a href="{{ url('/media-admin-edit/'.$m->id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil-square-o "></span></a>
                                    <a href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $m->title }} ', '{{ url('/media-admin-delete/'.$m->id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a>
                                </td> 
                            </tr>   
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nadpis</th>
                                <th>Typ</th>
                                <th>Zdroj</th>
                                <th>Dátum</th>
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