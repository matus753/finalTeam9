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
<div class="container">
    <div class="staff-intra">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="pull-left">
                    <a href="{{ url('/subjects-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                </div>
                <div class="text-center">
                    <h2>Pridanie predmetu</h2>
                </div>
            </div>
        </div>
        <form action="{{ url('/subjects-admin-add-action') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="sk_title">*Slovenský názov</label>
                        <input type="text" id="sk_title" class="form-control" name="sk_title" placeholder="Slovenský názov" required />
                    </div>
                    <div class="form-group">
                        <label for="en_title">*Anglický názov</label>
                        <input type="text" id="en_title" class="form-control" name="en_title" placeholder="Anglický názov" required/>
                    </div>
                    <div class="form-group">
                        <label for="abbr">*Skratka:</label>
                        <input type="text" id="abbr" class="form-control" name="abbr" placeholder="Skratka" required/>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="prednaska">*Trvanie prednášky:</label>
                        <input type="number" id="prednaska" class="form-control" name="prednaska" value="1" min="1" max="10" required/>
                    </div>
                    <div class="form-group">
                        <label for="cvicenie">*Trvanie cvičenia:</label>
                        <input type="number" id="cvicenie" class="form-control" name="cvicenie" value="1" min="1" max="10" required/>
                    </div>
                    <div class="form-group">
                        <label for="semester">*Semester:</label>
                        <select id="semester" class="form-control" name="semester" required>
                            <option value="0" @if($semester == 0) {{ 'selected' }} @endif>Zimný</option>
                            <option value="1" @if($semester == 1) {{ 'selected' }} @endif>Letný</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-1 " style="width: 92%">
                    <div class="form-group">
                        <label for="sk-editor" style="width: 100%">Dlhý text:</label>
                        <textarea id="sk-editor" rows="20" name="editor_content_sk" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="en-editor" style="width: 100%">Long text:</label>
                        <textarea id="en-editor" rows="20" name="editor_content_en" ></textarea>
                    </div>
                </div>
            </div>


            <div class="row text-center lastButton">
                <input type="submit" class="btn btn-success" value="Uložiť predmet" />
            </div>
        </form>
    </div>
</div>

@stop