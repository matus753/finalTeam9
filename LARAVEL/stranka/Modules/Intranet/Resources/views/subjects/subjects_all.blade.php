@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content_admin')
<div class="container">
	<div class="row">
		<div class="intra-div">
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>Administácia predmetov</h2>
                <div class="table-responsive tableIntra">
                    <table class="table table-bordered table-stripped intranet-table">
                        <thead>
                        <tr>
                            <th class="col-md-2">Skratka</th>
                            <th class="col-md-9">Nazov</th>
                            <th class="col-md-1 text-center">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $key => $subject)
                            <tr style="background-color: #f5f5f5">
                                <th class="col-md-2">{{ $subject->abbrev }}</th>
                                <th class="col-md-9"><a href="{{ url('/subjects-admin-info-item/'.$subject->sub_id) }}" >{{ $subject->title }}</a></th>
                                <th class="col-md-1 text-center">
                                    <a href ="{{ url('/subjects-admin-edit-info-item/'.$subject->sub_id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil" ></span></a>
                                    <a href ="{{ url('/subjects-admin-add-item/'.$subject->sub_id) }}" class="btn btn-primary btn-sm" ><span class="fa fa-plus" ></span></a>
                                </th>
                            </tr>
                            @foreach($subject->subcategories as $s)
                                <tr>
                                    <td class="col-md-2" style="padding-left:20px;">{{ $subject->abbrev }}</td>
                                    <td class="col-md-9" style="text-align: left;"><a href="{{ url('/subjects-admin-subcategory-show/'.$s->ss_id) }}">{{ $s->name_sk }}</a></td>
                                    <td class="col-md-1">
                                        <a href="{{ url('/subjects-admin-edit-item/'.$s->ss_id) }}" class="btn btn-success btn-xs" ><span class="fa fa-pencil" ></span></a>
                                        <a href="{{ url('/subjects-admin-delete-item/'.$s->ss_id) }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash-o" ></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @endforeach
                    </table>
                </div>
            <div id="add_item" >

            </div>
            <div id="items" >
               
            </div>
		</div>
	</div>
</div>   

@stop