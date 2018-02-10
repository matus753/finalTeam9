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
                <a href="{{ url('/photos-admin-add') }}" class="btn btn-primary">Vytvor galeriu</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <br>
            <h2>FUNKCIONALITA OK - treba test + remove bad string</h2>
            <br>
            <br> 
			<div class="text-center">
                <div class="table-responsive">
                    <table id="projects-table" class="table table-stripped table-bordered" >
                        <thead>
                            <tr>
                                <th>Nadpis</th>
                                <th>Datum</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($photos as $p)
                            <tr>  
                                <td>{{ $p->title }}</td>  
                                <td><span class="hidden">{{ $p->date }}</span>{{ format_time($p->date) }}</td>  
                                <td>
                                    <a href="{{ url('/photos-admin-edit/'.$p->pg_id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil-square-o "></span></a>
                                    <a href="javascript:void(0)" onclick="confirmation_redirect('Zmazanie záznamu {{ $p->title }}','Vymazanie záznamu spôsobí aj zmazanie obrázkov.Naozaj chcete zmazať tento záznam? {{ $p->title }} ', '{{ url('/photos-admin-delete/'.$p->pg_id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a>
                                    @if($activation)
                                    <a href="{{ url('/photos-admin-activate-gallery/'.$p->pg_id) }}" class="btn @if($p->activated)  btn-warning @else btn-primary @endif btn-sm" title="@if($p->activated) Deactivate @else Activate @endif" >@if($p->activated) <span class="fa fa-thumbs-down "> @else <span class="fa fa-thumbs-up ">@endif</span></a>
                                    @endif
                                </td> 
                            </tr>   
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nadpis</th>
                                <th>Datum</th>
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