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
        $('#news-table').DataTable();  
    });
</script>

<div id="emPAGEcontent" class="container">
    <div class="row">
        <div class="text-center">
            <h1>Administácia aktualít</h1>
        </div>
    </div>
    TO DO:<br>
    asi farebne odlíšiť expirované.. aj FILTER dať, aký ?? <br>
    Bulk delete ?<br>
	<div class="row">
		<div class="col-md-12">
            <div class="pull-right">
                <a href="{{ url('/news-admin-add') }}" class="btn btn-primary">Pridaj aktualitu</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <br>
            <br>
            <br>
			<div class="text-center">
                <div class="table-responsive">
                    <table id="news-table" class="table table-stripped table-bordered" >
                        <thead>
                            <tr>
                                <th>Nadpis</th>
                                <th>Typ</th>
                                <th>Expirácia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $n)
                            <tr>  
                                <td>{{ $n->title_sk }}</td>  
                                <td>{{ $n->type }}</td>  
                                <td><span class="hidden">{{ $n->date_expiration }}</span>{{ format_time($n->date_expiration) }}</td> 
                                <td>
                                    <a href="{{ url('/news-admin-edit/'.$n->id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil-square-o "></span></a>
                                    <a href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $n->title_sk }} ', '{{ url('/news-admin-delete/'.$n->id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a>
                                </td> 
                            </tr>   
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nadpis</th>
                                <th>Typ</th>
                                <th>Expirácia</th>
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