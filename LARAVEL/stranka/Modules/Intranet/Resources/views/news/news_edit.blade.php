@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>

<link rel="stylesheet" href="{{ URL::asset('plugins/froala/css/froala_editor.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/froala/css/plugins/image.min.css') }}">

<script src="{{ URL::asset('plugins/froala/js/froala_editor.min.js') }}"></script>
<script src="{{ URL::asset('plugins/froala/js/plugins/image.min.js') }}"></script>
<script src="{{ URL::asset('plugins/froala/js/plugins/link.min.js') }}"></script>
@stop

@section('content_admin')
<script>
    $(document).ready(function(){
        $.FroalaEditor.DefineIcon('imageInfo', {NAME: 'info'});
        $.FroalaEditor.RegisterCommand('imageInfo', {
            title: 'Info',
            focus: false,
            undo: false,
            refreshAfterCallback: false,
            callback: function () {
                var $img = this.image.get();
                alert($img.attr('src'));
            }
        });

        $('#froala-editor').froalaEditor({
            toolbarInline: false,
            useClasses: false,
            requestHeaders: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            imageEditButtons: ['imageDisplay', 'imageAlign', 'imageInfo', 'imageRemove'],
            // images upload
            imageUploadParam: 'image',
            imageUploadURL: '{{ url("/news-admin/news_image_upload") }}',
            imageUploadParams: { news_id_hash: '{{ $item->hash_id }}' },
            imageUploadMethod: 'POST',
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'giff'],
            // file upload
            fileUploadParam: 'attachment',
            fileUploadURL: '{{ url("/news-admin/news_file_upload") }}',
            fileUploadParams: { news_id_hash: '{{ $item->hash_id }}' },
            fileUploadMethod: 'POST',
            fileMaxSize: {{ $file_max_size }},
            fileAllowedTypes: ['*']
        });

        $('#froala-editor-en').froalaEditor({
            toolbarInline: false,
            useClasses: false,
            imageEditButtons: ['imageDisplay', 'imageAlign', 'imageInfo', 'imageRemove'],
            // images upload
            imageUploadParam: 'image',
            imageUploadURL: '{{ url("/news-admin/news_image_upload") }}',
            requestHeaders: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            imageUploadParams: { news_id_hash: '{{ $item->hash_id }}' },
            imageUploadMethod: 'POST',
            imageAllowedTypes: ['jpeg', 'jpg', 'png', 'giff'],
            // file upload
            fileUploadParam: 'attachment',
            fileUploadURL: '{{ url("/news-admin/news_file_upload") }}',
            fileUploadParams: { news_id_hash: '{{ $item->hash_id }}' },
            fileUploadMethod: 'POST',
            fileMaxSize: {{ $file_max_size }},
            fileAllowedTypes: ['*']
        });
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
                @if($item->editor_content_sk)
                <div class="form-group">
                    <label for="froala-editor">Dlhý text:</label>
                    <textarea id="froala-editor"  class="fr-view" name="editor_content_sk">{{ $item->editor_content_sk }}</textarea>
                </div>
                @else
                <div class="form-group">
                    <label for="froala-editor">Dlhý text:</label>
                    <textarea id="froala-editor"  class="fr-view" name="editor_content_sk"></textarea>
                </div>
                @endif
                @if($item->editor_content_en)
                    <div class="form-group">
                        <label for="froala-editor_en">Long text:</label>
                        <textarea id="froala-editor-en" name="editor_content_en">{{ $item->editor_content_en }}</textarea>
                    </div>
                @else
                    <div class="form-group">
                        <label for="froala-editor_en">Long text:</label>
                        <textarea id="froala-editor-en" name="editor_content_en"></textarea>
                    </div>
                @endif
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