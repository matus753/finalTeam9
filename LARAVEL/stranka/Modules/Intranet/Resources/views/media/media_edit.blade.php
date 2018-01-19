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
                        <h3>Editácia média: {{ $media->title }}</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/media-admin-edit-action/') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <select class="form-control" id="type" name="type" onchange="type_change()" >
                        @foreach($types as $key => $t)
                            <option value="{{ $key }}" @if($key == $media->type) {{ 'selected' }} @endif>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title_sk">Slovenský nadpis:</label>
                    <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" value="{{ $media->title }}" required />
                </div>
                <div class="form-group">
                    <label for="title_en">Anglický nadpis:</label>
                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" value="{{ $media->title_EN }}" required />
                </div>
                <div class="form-group">
                    <label for="media">Zdroj:</label>
                    <input type="text" class="form-control" id="media" name="media" placeholder="Zdroj" value="{{ $media->media }}" required />
                </div>
                <div class="form-group">
                    <label for="date">Dátum:</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Zdroj" value="{{ $media->date }}" required />
                </div>
                <div id="div_link" class="form-group @if($media->type == 'server' || $media->type == 'both') {{ 'hidden' }} @endif">
                    <label for="link">Link:</label>
                    <input type="text" class="form-control" id="link" name="link" value="{{ $media->url }}" placeholder="Link" />
                </div>
                <div id="div_file" class="form-group @if($media->type == 'link' || $media->type == 'both') {{ 'hidden' }} @endif">
                    <label for="file">@if($media->filename){{ 'Nahradenie súboru:' }} @else {{ 'Súbor:' }} @endif </label>
                    <input type="file" class="form-control" id="file" name="file" value="{{ $media->filename }}" placeholder="Súbor" />
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Ulož" />
            </form>
            ak viacero suborov tak spravcu ?
            @if($media->filename != null)
                <div class="row">
                    <div class="pull-left">
                        <h4>Tento záznam už obsahuje súbors názvom: <small>{{ $media->filename }}</small></h4>
                    </div>
                </div>
            @endif
		</div>
	</div>

</div>   
@stop