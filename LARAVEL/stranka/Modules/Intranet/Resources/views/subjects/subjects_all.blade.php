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
            @if(has_permission('admin'))
            <div class="pull-right">
                <a href="{{ url('/subjects-admin-add') }}" class="btn btn-primary"> Pridať predmet </a>
            </div>
            @endif
            <h2>Administrácia predmetov</h2>
            <div class="table-responsive tableIntra">
                <table class="table table-bordered table-stripped intranet-table">
                    <thead>
                    <tr>
                        <th class="col-md-2">Skratka</th>
                        <th class="col-md-8">Nazov</th>
                        <th class="col-md-2 text-center">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $key => $subject)
                        <tr style="background-color: #f5f5f5">
                            <th class="col-md-2">{{ $subject->abbrev }}</th>
                            <th class="col-md-8"><a href="{{ url('/subjects-admin-info-item/'.$subject->sub_id) }}" >{{ $subject->title }}</a></th>
                            <th class="col-md-2 text-center">
                                <a href ="{{ url('/subjects-admin-add-item/'.$subject->sub_id) }}" class="btn btn-primary btn-sm" ><span class="fa fa-plus" ></span></a>
                                <a href ="{{ url('/subjects-admin-edit-info-item/'.$subject->sub_id) }}" class="btn btn-success btn-sm" ><span class="fa fa-pencil" ></span></a>
                                @if(has_permission('admin')) <a title="Delete" href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $subject->title }} ', '{{ url('/subjects-admin-delete/'.$subject->sub_id) }}' )" class="btn btn-danger btn-sm" ><span class="fa fa-trash-o "></span></a> @endif
                            </th>
                        </tr>
                        @foreach($subject->subcategories as $s)
                            <tr>
                                <td class="col-md-2" style="padding-left:20px;">{{ $subject->abbrev }}</td>
                                <td class="col-md-8" style="text-align: left;"><a href="{{ url('/subjects-admin-subcategory-show/'.$s->ss_id) }}">{{ $s->name_sk }}</a></td>
                                <td class="col-md-2">
                                    <a href="{{ url('/subjects-admin-edit-item/'.$s->ss_id) }}" class="btn btn-success btn-xs" ><span class="fa fa-pencil" ></span></a>
                                    <a href="{{ url('/subjects-admin-delete-item/'.$s->ss_id) }}" class="btn btn-danger btn-xs" ><span class="fa fa-trash-o" ></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @endforeach
                </table>
            </div>
		</div>
	</div>
</div>   

@stop