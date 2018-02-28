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
    var type;
    $(document).ready(function(){
        type = $('#type').val();
        if( type == 'link'){
            $('#div_link').removeClass('hidden');
        }
        if( type == 'server' ){
            $('#div_file').removeClass('hidden');
        }
        if( type == 'both' ){
            $('#div_link').removeClass('hidden');
            $('#div_file').removeClass('hidden');
        }
    });

    function type_change(){
        type = $('#type').val();
        if( type == 'link'){
            $('#div_link').removeClass('hidden');
            $('#div_file').addClass('hidden');
        }
        if( type == 'server' ){
            $('#div_file').removeClass('hidden');
            $('#div_link').addClass('hidden');
        }
        if( type == 'both' ){
            $('#div_link').removeClass('hidden');
            $('#div_file').removeClass('hidden');
        }
    }

</script>

<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('/media-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Pridanie nového média</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/media-admin-add-action') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <select class="form-control" id="type" name="type" onchange="type_change()" >
                        @foreach($types as $key => $t)
                            <option value="{{ $key }}">{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title_sk">Slovenský nadpis:</label>
                    <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" required />
                </div>
                <div class="form-group">
                    <label for="title_en">Anglický nadpis:</label>
                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" required />
                </div>
                <div class="form-group">
                    <label for="media">Zdroj:</label>
                    <input type="text" class="form-control" id="media" name="media" placeholder="Zdroj" required />
                </div>
                <div class="form-group">
                    <label for="date">Dátum:</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Zdroj" />
                </div>
                <div id="div_link" class="form-group hidden">
                    <label for="link">Link:</label>
                    <input type="text" class="form-control" id="link" name="link" placeholder="Link" />
                </div>
                <div id="div_file" class="form-group hidden">
                    <label for="file">Súbor:</label>
                    <input type="file" class="form-control" id="file" name="files[]" placeholder="Súbor" multiple/>
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Pridaj" />
            </form>
		</div>
	</div>

</div>   
@stop