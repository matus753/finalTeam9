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
                        <h3 style=" margin-left: 10%;">Editácia média: {{ $media->title }}</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/media-admin-edit-action/'.$media->m_id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="type">Typ:</label>
                            <select class="form-control" id="type" name="type" onchange="type_change()" >
                                @foreach($types as $key => $t)
                                    <option value="{{ $key }}" @if($key == $media->type) {{ 'selected' }} @endif>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="media">Zdroj:</label>
                            <input type="text" class="form-control" id="media" name="media" placeholder="Zdroj" value="{{ $media->media }}" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="title_sk">Slovenský nadpis:</label>
                            <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" value="{{ $media->title }}" required />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="date">Dátum:</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Zdroj" value="{{ format_time($media->date, true) }}" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="title_en">Anglický nadpis:</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" value="{{ $media->title_EN }}" required />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div id="div_link" class="form-group @if($media->type == 'server') {{ 'hidden' }} @endif">
                            <label for="link">Link:</label>
                            <input type="text" class="form-control" id="link" name="link" value="{{ $media->url }}" placeholder="Link" />
                        </div>
                        <div id="div_file" class="form-group @if($media->type == 'link' ) {{ 'hidden' }} @endif">
                            <label for="file">Súbor(y) <small>Povolené typy súborov: {{ $allowed }}</small></label>
                            <input type="file" class="form-control" id="file" name="files[]" value="" placeholder="Súbor" multiple/>
                        </div>
                    </div>
                </div>

                @if(count($files))
                <input type="hidden" name="has_files" value="1" />
                @else
                <input type="hidden" name="has_files" value="0" />
                @endif
                <input type="submit" class="btn btn-success pull-right" value="Ulož" />
            </form>
            <div style="margin-top: 50px">
                @if(count($files))
                    <h3>Súbory pri uploadnutí nových budú zmazané!</h3>
                    @foreach($files as $f)
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-10">
                            <h4>Tento záznam obsahuje súbor s názvom: <small>{{ $f->file_name }}</small></h4>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
		</div>
	</div>

</div>   
@stop