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
                        <h3>Pridanie predmetu</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/subjects-admin-add-action') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="sk_title">Slovenský názov</label>
                                <input type="text" id="sk_title" class="form-control" name="sk_title" placeholder="Slovenský názov" required />
                            </div> 
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="en_title">Anglický názov:</label>
                                <input type="text" id="en_title" class="form-control" name="en_title" placeholder="Anglický názov" required/>
                            </div> 
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="abbr">Skratka:</label>
                                <input type="text" id="abbr" class="form-control" name="abbr" placeholder="Skratka" required/>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="prednaska">Trvanie prednášky:</label>
                        <input type="number" id="prednaska" class="form-control" name="prednaska" value="1" min="1" max="10" required/>
                    </div> 
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cvicenie">Trvanie cvičenia:</label>
                        <input type="number" id="cvicenie" class="form-control" name="cvicenie" value="1" min="1" max="10" required/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="semester">Semester:</label>
                        <select id="semester" class="form-control" name="semester" required>
                            <option value="0" @if($semester == 0) {{ 'selected' }} @endif>Zimný</option>
                            <option value="1" @if($semester == 1) {{ 'selected' }} @endif>Letný</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sk-editor">Dlhý text:</label>
                    <textarea id="sk-editor" name="editor_content_sk"></textarea>
                </div>
                <div class="form-group">
                    <label for="en-editor">Long text:</label>
                    <textarea id="en-editor"  name="editor_content_en"></textarea>
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Ulož" />
            </form>
		</div>
	</div>
</div>  

@stop