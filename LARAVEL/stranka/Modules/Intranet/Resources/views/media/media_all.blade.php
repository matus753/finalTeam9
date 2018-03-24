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

<div class="container">
    <div class="row">
        <div class="intra-div">
            <div class="pull-right">
                <a href="{{ url('/media-admin-add') }}" class="btn btn-primary">Pridať médium</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>Média</h2>
			<div class="text-center">
                <div class="table-responsive">
                    <table id="projects-table" class="table table-stripped table-bordered intranet-table">
                        <thead>
                            <tr class="intranet-table__table-title">
                                <th>Nadpis</th>
                                <th>Typ</th>
                                <th>Zdroj</th>
                                <th>Dátum</th>
                                <th class="pCol4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($media as $m)
                            <tr class="intranet-table__table-title">  
                                <td>{{ $m->title }}</td>  
                                <td>{{ $m->type }}</td>  
                                <td>{{ $m->media }}</td> 
                                <td><span class="hidden">{{ $m->date }}</span>{{ format_time($m->date) }}</td> 
                                <td class="pCol4">
                                    <a href="{{ url('/media-admin-edit/'.$m->m_id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil-square-o "></span></a>
                                    <a href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $m->title }} ', '{{ url('/media-admin-delete/'.$m->m_id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a>
                                </td> 
                            </tr>   
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="intranet-table__table-title">
                                <th>Nadpis</th>
                                <th>Typ</th>
                                <th>Zdroj</th>
                                <th>Dátum</th>
                                <th class="pCol4"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@stop