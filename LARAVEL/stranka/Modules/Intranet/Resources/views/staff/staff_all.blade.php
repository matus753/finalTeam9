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
                <a href="{{ url('/staff-admin-add') }}" class="btn btn-primary">Pridaj ľuď</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <br>
            <h2>FUNKCIONALITA OK - treba test + remove bad string</h2>
            <h2>Q: profile staci ? klik na meno</h2>
            <br>
            <br>
			<div class="text-center">
                <div class="table-responsive">
                    <table id="projects-table" class="table table-stripped table-bordered intranet-table">
                        <thead>
                            <tr class="intranet-table__table-title">
                                <th>Meno</th>
                                <th>Oddelenie</th>
                                <th>Rola</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staff as $s)
                            <tr>  
                                <td> <a href="{{ url('/staff-admin-show-profile/'.$s->id) }}">{{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }}</a></td>
                                <td>{{ $s->department }}</td>  
                                <td>{{ $s->staffRole }}</td> 
                                <td>
                                    <a href="{{ url('/staff-admin-edit/'.$s->id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil-square-o "></span></a>
                                    <a href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }} ', '{{ url('/staff-admin-delete/'.$s->id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a>
                                </td> 
                            </tr>   
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="intranet-table__table-title">
                                <th>Meno</th>
                                <th>Oddelenie</th>
                                <th>Rola</th>
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