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
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('/documents-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Pridanie noveho zaznamu do kategorie {{ $category->name_sk }}</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/documents-admin-add-item-action') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="save_to" value="{{ $hash_id }}" />
                <input type="hidden" name="category" value="{{ $category->hash_name }}" />
                <input type="hidden" name="category_id" value="{{ $category->dc_id }}" />
                <div class="form-group">
                    <label for="title_sk">Slovenský nadpis:</label>
                    <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" required />
                </div>
                <div class="form-group">
                    <label for="title_en">Anglický nadpis:</label>
                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" required />
                </div>
                <div class="form-group">
                    <label for="sk-editor">Dlhý text:</label>
                    <textarea id="sk-editor" name="editor_content_sk"></textarea>
                </div>
                <div class="form-group">
                    <label for="en-editor">Long text:</label>
                    <textarea id="en-editor"  name="editor_content_en"></textarea>
                </div>
                <div class="form-group">
                    <label for="dropzone">Additional files:</label>
                    <div class="dropzone" id="dropzone"></div>
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Pridaj" />
            </form>
		</div>
	</div>
</div>  

@stop