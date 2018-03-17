@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content_admin')
<div id="emPAGEcontent" class="container">
    <div class="row">
        <div class="text-center">
            <h1>Administácia predmetov</h1>
        </div>
    </div>
    <hr>
	<div class="row">
		<div class="col-md-12">
            <div class="pull-right">
                <a href="#" class="btn btn-primary">TUTO BY SOM DAL UPLOAD CSV FILE S PREDMETMI PRE NEJAKU ROLU -> UPDATE DB</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <br>
            <br>
            <br>

            @foreach($subjects as $key => $subject)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ $subject->abbrev }}</th>
                                <th>{{ $subject->title }}</th>
                                <th><a href ="{{ url('/subjects-admin-add-item/'.$subject->sub_id) }}" class="btn btn-primary btn-sm" ><span class="fa fa-plus-square fa-2x" ></span></a></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($subject->subcategories as $s)
                            <tr>
                                <td>{{ $subject->abbrev }}</td>
                                <td>{{ $s->name_sk }}</td>
                                <td>
                                    <a href="{{ url('/subjects-admin-edit-item/'.$s->ss_id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil fa-2x" ></span></a>
                                    <a href="{{ url('/subjects-admin-delete-item/'.$s->ss_id) }}" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o fa-2x" ></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
            </ul>
            <div id="add_item" >

            </div>
            <div id="items" >
               
            </div>
		</div>
	</div>
</div>   

@stop