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

<div class="container">
    <div class="row">
        <div class="intra-div">
            <div class="pull-right">
                <a href="{{ url('/news-admin-add') }}" class="btn btn-primary">Pridať aktualitu</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>Administácia aktualít</h2>
            <h3>TO DO:<br>
                asi farebne odlíšiť expirované.. aj FILTER dať, aký ?? <br>
                Bulk delete ?<br></h3>
			<div class="text-center">
                <div class="table-responsive">
                    <table id="news-table" class="table table-stripped table-bordered intranet-table">
                        <thead>
                            <tr class="intranet-table__table-title">
                                <th>Nadpis</th>
                                <th>Typ</th>
                                <th>Expirácia</th>
                                <th class="pCol4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $n)
                            <tr>  
                                <td>{{ $n->title_sk }}</td>  
                                <td>{{ $n->type }}</td>  
                                <td><span class="hidden">{{ $n->date_expiration }}</span>{{ format_time($n->date_expiration) }}</td> 
                                <td class="pCol4">
                                    <a href="{{ url('/news-admin-edit/'.$n->id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil-square-o "></span></a>
                                    <a href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $n->title_sk }} ', '{{ url('/news-admin-delete/'.$n->id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a>
                                </td> 
                            </tr>   
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="intranet-table__table-title">
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