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
                                <th class="col-md-2">{{ $subject->abbrev }}</th>
                                <th class="col-md-9"><a href="{{ url('/subjects-admin-info-item/'.$subject->sub_id) }}" >{{ $subject->title }}</a></th>
                                <th class="col-md-1 text-center">
                                    <a href ="{{ url('/subjects-admin-edit-item/'.$subject->sub_id) }}" class="btn btn-success btn-xs" ><span class="fa fa-pencil" ></span></a>
                                    <a href ="{{ url('/subjects-admin-add-item/'.$subject->sub_id) }}" class="btn btn-primary btn-xs" ><span class="fa fa-plus" ></span></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($subject->subcategories as $s)
                            <tr>
                                <th class="col-md-2">{{ $subject->abbrev }}</td>
                                <th class="col-md-9"><a href="{{ url('/subjects-admin-subcategory-show/'.$s->ss_id) }}">{{ $s->name_sk }}</a></td>
                                <th class="col-md-1 text-center">
                                    <a href="{{ url('/subjects-admin-edit-item/'.$s->ss_id) }}" class="btn btn-success btn-xs" ><span class="fa fa-pencil" ></span></a>
                                    <a href="{{ url('/subjects-admin-delete-item/'.$s->ss_id) }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash-o" ></span></a>
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