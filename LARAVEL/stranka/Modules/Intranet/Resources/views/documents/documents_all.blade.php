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
        <div class="intra-div">
            <div class="pull-right">
                <a href="{{ url('/documents-admin-add-category') }}" class="btn btn-primary">Pridaj kategoriu</a>
            </div>
            <div class="pull-left">
                <a href="{{ url('/intranet') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>Administácia dokumentov</h2>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="tabs">
                        @foreach($categories as $key => $c)
                            @if($key == 0)
                                <li class="active"><a id="{{ $c->dc_id }}">{{ $c->name_sk }}</a></li>
                            @else
                                <li><a id="{{ $c->dc_id }}">{{ $c->name_sk }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <div id="add_item" class="row"></div>
                    <table class="table table-bordered table-stripped" id="items">
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   

<script>
    $(document).ready(function(){
        var data = { 'id' : $('#tabs .active a').attr('id') };
        $.ajax({
            url: "{{ url('/documents-admin-get-content') }}",
            type: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data){
            if(data['tab'] != null){
                $('#add_item').empty().append('<div class="col-md-4"><a href="{{ url("/documents-admin-add-item") }}/'+data['tab']+'" class="btn btn-primary full-w">Pridaj záznam</a></div>');
                $('#add_item').append('<div class="col-md-4"><a href="{{ url("/documents-admin-delete-category") }}/'+data['tab']+'" class="btn btn-danger full-w">Zmazanie kategórie</a></div>');
                $('#add_item').append('<div class="col-md-4"><a href="{{ url("/documents-admin-edit-category") }}/'+data['tab']+'" class="btn btn-success full-w">Edit kategórie</a></div>');
            }
            if(data['docs'] != null){
                console.log(data['docs']);
                $('#items').empty();
                for(let i = 0; i < data['docs'].length; i++){
                    $('#items').append('<tr class="well well-default">' +
                        '<td class=""><a style="padding-left: 20px;" href={{ url("/documents-admin-show") }}/'+data['docs'][i].d_id+'>'+data['docs'][i].name_sk+'</a></td>'+
                        '<td class="text-center" style="width: 100px;"><a href="{{ url("/documents-admin-delete-item") }}/'+data['docs'][i].d_id+'" class="btn btn-danger btn-sm"><span class="fa fa-trash-o "></span></a>'+
                        '<a href="{{ url("/documents-admin-edit-category-item") }}/'+data['docs'][i].d_id+'" class="btn btn-success btn-sm"><span class="fa fa-pencil-square-o "></span></a></td>'+
                        '</tr>');
                }
            }
        });
    });

    $('#tabs a').on('click', function(){
        var data = { 'id' : $(this).attr('id') };
        $clicked_tab = $(this);
        $.ajax({
            url: "{{ url('/documents-admin-get-content') }}",
            type: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data){
            $('#tabs li.active').removeClass('active');
            $clicked_tab.parent().addClass('active');
            
            if(data['tab'] != null){
                $('#add_item').empty().append('<div class="col-md-4"><a href="{{ url("/documents-admin-add-item") }}/'+data['tab']+'" class="btn btn-primary full-w">Pridaj záznam</a></div>');
                $('#add_item').append('<div class="col-md-4"><a href="{{ url("/documents-admin-delete-category") }}/'+data['tab']+'" class="btn btn-danger full-w">Zmazanie kategórie</a></div>');
                $('#add_item').append('<div class="col-md-4"><a href="{{ url("/documents-admin-edit-category") }}/'+data['tab']+'" class="btn btn-success full-w">Edit kategórie</a></div>');
            }
            if(data['docs'] != null){
                $('#items').empty();
                for(let i = 0; i < data['docs'].length; i++){
                    $('#items').append('<tr class="well well-default">' +
                        '<td class="col-lg-10"><a href={{ url("/documents-admin-show") }}/'+data['docs'][i].d_id+'>'+data['docs'][i].name_sk+'</a></td>'+
                        '<td class="col-lg-2"><a href="{{ url("/documents-admin-delete-item") }}/'+data['docs'][i].d_id+'" class="btn btn-danger pull-right"><span class="fa fa-trash-o "></span></a>'+
                        '<a href="{{ url("/documents-admin-edit-category-item") }}/'+data['docs'][i].d_id+'" class="btn btn-success pull-right"><span class="fa fa-pencil-square-o "></span></a></td>'+
                        '</tr>');
                }
            }
        });

    });
</script>


@stop