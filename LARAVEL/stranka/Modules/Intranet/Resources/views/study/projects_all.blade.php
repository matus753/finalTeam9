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
                <a href="{{ url('/projects-admin-add') }}" class="btn btn-primary">Pridať projekt</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>Projekty</h2>
			<div class="text-center">
                {{--<h2>FUNKCIONALITA OK - treba test + remove bad string</h2>--}}
                <div class="table-responsive tableIntra">
                    <table id="projects-table" class="table table-stripped table-bordered intranet-table">
                        <thead>
                            <tr class="intranet-table__table-title">
                                <th class="pCol1">Nadpis</th>
                                <th class="pCol2">Typ</th>
                                <th class="pCol3">Číslo projektu</th>
                                <th class="pCol4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $p)
                            <tr>
                                <td class="pCol1">{{ $p->titleSK }}</td>
                                <td class="pCol2">{{ $p->projectType }}</td>
                                <td class="pCol3">{{ $p->number }}</td>
                                <td class="pCol4">
                                    <a title="Edit" href="{{ url('/projects-admin-edit/'.$p->pr_id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil-square-o "></span></a>
                                    <a title="Delete" href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $p->titleSK }} ', '{{ url('/projects-admin-delete/'.$p->pr_id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a>
                                    @if($activation)
                                    {{--<a href="{{ url('/photos-admin-activate-project/'.$p->pr_id) }}" class="btn @if($p->activated)  btn-warning @else btn-primary @endif btn-sm" title="@if($p->activated) Deactivate @else Activate @endif" >@if($p->activated) <span class="fa fa-thumbs-down "> @else <span class="fa fa-thumbs-up ">@endif</span></a>--}}
                                    <a href="{{ url('/photos-admin-activate-project/'.$p->pr_id) }}" class="btn @if($p->activated)  btn-warning @else btn-primary @endif btn-sm" title="@if($p->activated) Active @else Deactive @endif" >@if($p->activated) <span class="fa fa-thumbs-up "> @else <span class="fa fa-thumbs-down ">@endif</span></a>
                                    @endif
                                </td> 
                            </tr>   
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="intranet-table__table-title">
                                <th>Nadpis</th>
                                <th>Typ</th>
                                <th>Číslo projektu</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
			</div>
            <div class="note">
                <h5>Poznámky:</h5>
                <p>- kliknutím na tlačidlo Aktívny projekt, projekt deaktivujete a naopak</p>
            </div>
		</div>
	</div>

</div>   
@stop