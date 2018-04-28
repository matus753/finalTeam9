@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>

<script src="{{ URL::asset('plugins/summernote/dist/summernote.js') }}"></script>
<link href="{{ URL::asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
<script src="{{ URL::asset('plugins/dropzone/dropzone.js') }}"></script>
<link href="{{ URL::asset('plugins/dropzone/dropzone.css') }}" rel="stylesheet">

@stop

@section('content_admin')
<script>
    
    $(document).ready(function(){
        $('#sk-editor').summernote({
            callbacks: {
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], this, welEditable);
                }
            }
        });
        $('#en-editor').summernote({
            callbacks: {
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], this, welEditable);
                }
            }
        });

        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("image", file);
            data.append("save_to", '{{ $hash_id }}');
            data.append("category", '{{ $category->hash_name }}');
            $.ajax({
                data: data,
                type: "POST",
                url: '{{ url("/documents-admin/documents_image_upload") }}',
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

        Dropzone.autoDiscover = false; // autosearch for div
		var myDropzone = new Dropzone("div#dropzone", 
			{ 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				url : "{{ url('/documents-files-admin-upload-action') }}",
				thumbnailWidth: 360, 
				thumbnailHeight: 360, 
				thumbnailMethod: 'crop',
				timeout: 9900000,
				uploadMultiple: true,
                parallelUploads: 1,
                autoProcessQueue: true,
                init: function() {
                    this.on("sending", function(file, xhr, formData){
                            formData.append("category", "{{ $category->hash_name }}");
                            formData.append("save_to", "{{ $hash_id }}");
                    });
                }
			}
		);

    });    

</script>
<div id="emPAGEcontent" class="container">
    <div class="intra-div">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="pull-left">
                    <a href="{{ url('/documents-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                </div>
                <h2>Editácia záznamu {{ $document->name_sk }} v kategórii {{ $category->name_sk }}</h2>
            </div>
        </div>
    </div>

    <form action="{{ url('/documents-admin-edit-category-item-action/'.$document->d_id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="save_to" value="{{ $hash_id }}" />
        <input type="hidden" name="category" value="{{ $category->hash_name }}" />
        <input type="hidden" name="category_id" value="{{ $category->dc_id }}" />

        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                    <div class="form-group">
                        <label for="title_sk">Slovenský nadpis:</label>
                        <input type="text" class="form-control" id="title_sk" name="title_sk" value="{{ $document->name_sk }}" placeholder="* Slovenský nadpis" required />
                    </div>
                    <div class="form-group">
                        <label for="sk-editor">Dlhý text:</label>
                        <textarea rows="8" class="form-control" id="sk-editor" name="editor_content_sk">{{ $document->text_sk }}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                    <div class="form-group">
                        <label for="title_en">Anglický nadpis:</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $document->name_en }}" placeholder="* Anglický nadpis" required />
                    </div>
                    <div class="form-group">
                        <label for="en-editor">Long text:</label>
                        <textarea rows="8" class="form-control" id="en-editor"  name="editor_content_en">{{ $document->text_en }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center lastButton">
            <div class="form-group col-md-offset-1">
                <label for="dropzone">Ďalšie súbory:</label>
                <p style="font-weight: bold; color: #d81d19; text-align: left">Povolené je vkladať iba súbory s príponami .zip, .rar, .pdf, .doc, .docx, .xls, .xlsx, .jpg, .png, .jpeg, .giff.</p>
                <div class="dropzone" id="dropzone"></div>
            </div>

            <input type="submit" class="btn btn-success" value="Uložiť" />
        </div>
    </form>
    <div class="row text-center lastButton">
        <p>Priložené súbory</p>
        @foreach($files as $f)
        <div class="row">
            <div class="col-md-12" style="background-color: lightgrey">
                <a href="{{ get_documents_file($category->hash_name, $hash_id, $f->file_hash) }}" class="pull-left">{{ $f->file_name }}</a>
                <a href="{{ url('/delete-file-in-item/'.$f->df_id) }}" class="btn btn-danger pull-right">DELETE</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop