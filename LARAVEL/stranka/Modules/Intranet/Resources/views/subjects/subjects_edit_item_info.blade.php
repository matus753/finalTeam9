@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>

<script src="{{ URL::asset('plugins/summernote/dist/summernote.js') }}"></script>
<link href="{{ URL::asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
@stop

@section('content_admin')
<style>
.note-group-select-from-files {
  display: none;
}
</style>
<script>
    $(document).ready(function(){
        $('#sk-editor').summernote();
        $('#en-editor').summernote();
    });    

</script>
<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('/subjects-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Editacia informácií o predmete {{ $subject->title }}</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/subjects-admin-edit-item-info-action/'.$sub_id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sk-editor">Trvanie prednášky:</label>
                        <input type="number" class="form-control" name="prednaska" placeholder="Trvanie prednášky" value="{{ $subject->duration_p }}" min="1" max="10" />
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sk-editor">Trvanie cvičenia:</label>
                        <input type="number" class="form-control" name="cvicenie" placeholder="Trvanie cvičenia" value="{{ $subject->duration_c }}" min="1" max="10" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="sk-editor">Dlhý text:</label>
                    <textarea id="sk-editor" name="editor_content_sk">@if($info) {{ $info->info_sk }} @endif</textarea>
                </div>
                <div class="form-group">
                    <label for="en-editor">Long text:</label>
                    <textarea id="en-editor"  name="editor_content_en">@if($info) {{ $info->info_en }} @endif</textarea>
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Ulož" />
            </form>
		</div>
	</div>
</div>  

@stop