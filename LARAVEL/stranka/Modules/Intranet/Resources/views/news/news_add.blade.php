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
            height: 100,
            callbacks: {
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], this, welEditable);
                }
            }
        });
        $('#en-editor').summernote({
            height: 100,
            callbacks: {
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0], this, welEditable);
                }
            }
        });

        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("image", file);
            data.append("news_id_hash", '{{ $hash_id }}');
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
                },
                error:function(request, status, error){
                    console.log(error);
                }
            }); 
        }

        Dropzone.autoDiscover = false; // autosearch for div
		var myDropzone = new Dropzone("div#dropzone", 
			{ 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				url : "{{ url('/news-admin/news_file_upload') }}",
				thumbnailWidth: 360, 
				thumbnailHeight: 360, 
				thumbnailMethod: 'crop',
				timeout: 9900000,
				uploadMultiple: true,
                parallelUploads: 1,
                autoProcessQueue: true,
                init: function() {
                    this.on("sending", function(file, xhr, formData){
                            formData.append("news_id_hash", "{{ $hash_id }}");
                    });
                }
			}
		);
        var p_sk = 1024;
        $('#skc').text(p_sk);
        $("#preview_sk").on('keyup paste', function(){
            let tmp = $(this).val().length;
            if(tmp > 1024){
                tmp = limitText(this, 1024);
            }else{
                tmp = p_sk - tmp;
                
            }
            $('#skc').text(tmp);
        });

        var p_en = 1024;
        $('#ske').text(p_en);
        $("#preview_en").on('keyup paste', function(){
            let tmp = $(this).val().length;
            if(tmp > 1024){
                tmp = limitText(this, 1024);    
            }else{
                tmp = p_en - tmp;
            }
            $('#ske').text(tmp);
        });
        

    });

    function limitText(field, maxChar){
        var ref = $(field),
            val = ref.val();
        if(val.length >= maxChar ){
            ref.val(function() {
                return val.substr(0, maxChar);       
            });
        }
    }
</script>

<div class="container">
    <div class="intra-div">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="pull-left">
                    <a href="{{ url('/news-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                </div>
                <h2>Pridanie novej aktuality</h2>
            </div>
        </div>

        <form name="projectForm" action="{{ url('/news-admin-add-action') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="news_id_hash" value="{{ $hash_id }}"/>
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                            <label for="title_sk">* Slovenský nadpis:</label>
                            <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" required />
                    </div>
                    <div class="form-group">
                        <label for="title_en">* Anglický nadpis:</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" required />
                    </div>
                    
                    <div class="form-group">
                        <label for="preview_sk">* Ukážkový text SK: <small id="skc" ></small></label>
                        <textarea class="form-control" rows="10" id="preview_sk" name="preview_sk" placeholder="Slovenský preview text" required ></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Ukážkový obrázok:</label>
                        <input type="file"  id="image" name="image" />
                    </div>
                </div>

                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="role">* Typ:</label>
                        <select class="form-control" name="type" id="type">
                            @foreach($types as $key => $t)
                                <option value="{{ $key }}">{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="expiration">Expirácia:</label>
                        <input type="date" class="form-control" id="expiration" name="expiration" placeholder="Expiration" />
                    </div>
                    <div class="form-group">
                        <label for="preview_en">* Ukážkový text EN: <small id="ske" ></small></label>
                        <textarea class="form-control" rows="10" id="preview_en" name="preview_en" placeholder="Anglický preview text" required ></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                     <hr>
                    <div class="form-group">
                        <label for="sk-editor">Dlhý text SK:</label>
                        <textarea class="form-control" rows="14" id="sk-editor" name="editor_content_sk"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="en-editor">Dlhý text EN:</label>
                        <textarea class="form-control" rows="14" id="en-editor"  name="editor_content_en"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dropzone">Dodatočné súbory:</label>
                        <p style="font-weight: bold; color: #d81d19; text-align: left">Povolené je vkladať iba súbory s príponami .jpg, .jpeg, .png, .giff.</p>
                        <div class="dropzone" id="dropzone"></div>
                    </div>
                </div>
            </div>
            <div class="row text-center lastButton">
                <div class="col-md-11 col-md-offset-1">
                    <input type="submit" class="btn btn-success" value="Pridať aktualitu" />
                </div>
            </div>
        </form>
    </div>
</div>
@stop