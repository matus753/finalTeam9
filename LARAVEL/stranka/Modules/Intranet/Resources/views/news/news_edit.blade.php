@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>

<link rel="stylesheet" href="{{ URL::asset('plugins/froala/css/froala_editor.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/froala/css/plugins/image.min.css') }}">

<script src="{{ URL::asset('plugins/summernote/dist/summernote.js') }}"></script>
<link href="{{ URL::asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
@stop

@section('content_admin')
<script>
    $(document).ready(function(){
        $('#sk-editor').summernote({
            callbacks: {
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], this, welEditable);
                }
            },
        
        });
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("image", file);
            data.append("news_id_hash", '{{ $item->hash_id }}');
            $.ajax({
                data: data,
                type: "POST",
                url: '{{ url("/news-admin/news_image_upload") }}',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))
                },
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    $(editor).summernote("insertImage", JSON.parse(url));
                }
            }); 
        }
    });    

</script>
<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('/news-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Editácia aktuality: {{ $item->title_sk }}</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/news-admin-edit-action/'.$item->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <select class="form-control" name="type">
                        @foreach($types as $key => $t)
                            <option value="{{ $key }}" @if($key == $item->type) {{ 'selected' }} @endif >{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="expiration">Expirácia:</label>
                    <input type="date" class="form-control" id="expiration" name="expiration" value="{{ format_time($item->date_expiration, true) }}" placeholder="Expiration">
                </div>
                <div class="form-group">
                    <label for="title_sk">Slovenský nadpis:</label>
                    <input type="text" class="form-control" id="title_sk" name="title_sk" value="{{ $item->title_sk }}" placeholder="Slovenský nadpis" required />
                </div>
                <div class="form-group">
                    <label for="title_en">Anglický nadpis:</label>
                    <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $item->title_en }}" placeholder="Anglický nadpis" required />
                </div>
                <div class="form-group">
                    <label for="preview_sk">Ukážkový text SK:</label>
                    <input type="text" class="form-control" id="preview_sk" name="preview_sk" value="{{ $item->preview_sk }}" placeholder="Slovenský preview text" required />
                </div>
                <div class="form-group">
                    <label for="preview_en">Ukážkový text EN:</label>
                    <input type="text" class="form-control" id="preview_en" name="preview_en" value="{{ $item->preview_en }}" placeholder="Anglický preview text" required />
                </div>
                
                <div class="form-group">
                    <label for="sk-editor">Dlhý text:</label>
                    <textarea id="sk-editor" name="editor_content_sk">{{ $item->editor_content_sk }}</textarea>
                </div>
                
                @if($item->image_hash_name)
                    TO DO REMOVE AFTER IMAGE CHANGE
                    <div class="form-group">
                        <label for="image">Ukážkový obrázok reupload:</label>
                        <input type="file" class="form-control" id="image" name="image" />
                    </div>
                    <img src="{{ get_news_image($item->image_hash_name) }}" class="img-responsive" alt="news_image" width="300" height="300">
                @else
                    <div class="form-group">
                        <label for="image">Ukážkový obrázok:</label>
                        <input type="file" class="form-control" id="image" name="image" />
                    </div>
                @endif
                <input type="submit" class="btn btn-success pull-right" value="Ulož" />
            </form>
		</div>
	</div>
</div>   
@stop