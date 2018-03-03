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
		<div class="staff-intra">
            <div class="pull-right">
                <a href="{{ url('/staff-admin-add') }}" class="btn btn-primary">Pridaj ľuď</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>Zamestnanci ústavu</h2>
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
                                <td> <a href="{{ url('/staff-admin-show-profile/'.$s->s_id) }}">{{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }}</a></td>
                                <td>{{ $s->department }}</td>  
                                <td>{{ $s->staffRole }}</td> 
                                <td>
                                    <a href="{{ url('/staff-admin-edit/'.$s->s_id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil-square-o "></span></a>
                                    <a href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }} ', '{{ url('/staff-admin-delete/'.$s->s_id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a>
                                    @if($activation)
                                    <a href="{{ url('/staff-admin-activate-user/'.$s->s_id) }}" class="btn @if($s->activated)  btn-warning @else btn-primary @endif btn-sm" title="@if($s->activated) Active @else Deactive @endif" >@if($s->activated) <span class="fa fa-thumbs-up "> @else <span class="fa fa-thumbs-down ">@endif</span></a>
                                    @endif
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
            <div class="staff__notes">
                <h5>Poznámky:</h5>
                <p>- kliknutím na tlačidlo Aktívny profil, profil deaktivujete a naopak</p>
            </div>
		</div>
	</div>
</div>   
@stop