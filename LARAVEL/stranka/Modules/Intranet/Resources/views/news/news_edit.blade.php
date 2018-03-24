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
        });
        /*function validateForm() {
            var x = document.forms["projectForm"]["title_sk"].value;
            var y = document.forms["projectForm"]["title_en"].value;
            var z = document.forms["projectForm"]["preview_sk"].value;
            var w = document.forms["projectForm"]["preview_en"].value;
            if (!x.trim()) {
                $("#req1").css("display", "block");
                event.preventDefault();
            } else {
                $("#req1").css("display", "none");
            }

            if (!y.trim()) {
                $("#req2").css("display", "block");
                event.preventDefault();
            } else {
                $("#req2").css("display", "none");
            }

            if (!z.trim()) {
                $("#req3").css("display", "block");
                event.preventDefault();
            } else {
                $("#req3").css("display", "none");
            }

            if (!w.trim()) {
                $("#req4").css("display", "block");
                event.preventDefault();
            } else {
                $("#req4").css("display", "none");
            }
        }*/
    </script>
    <div class="container">
        <div class="intra-div">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="pull-left">
                        <a href="{{ url('/news-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                    </div>
                    <h2>{{ $item->title_sk }}</h2>
                </div>
            </div>
                <form name="projectForm"  action="{{ url('/news-admin-edit-action/'.$item->n_id) }}" method="post" enctype="multipart/form-data" onsubmit="validateForm()">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group">
                                <label for="role">* Typ:</label>
                                <select class="form-control" name="type">
                                    @foreach($types as $key => $t)
                                        <option value="{{ $key }}" @if($key == $item->type) {{ 'selected' }} @endif >{{ $t }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="news_id_hash" value="{{ $item->hash_id }}">
                            <div class="form-group">
                                <label for="expiration">Expirácia:</label>
                                <input type="date" class="form-control" id="expiration" name="expiration" value="{{ format_time($item->date_expiration, true) }}" placeholder="Expiration">
                            </div>
                            <div class="form-group">
                                <label for="title_sk">* Slovenský nadpis:</label>
                                <input type="text" class="form-control" id="title_sk" name="title_sk" value="{{ $item->title_sk }}" placeholder="Slovenský nadpis" required />
                                <p class="required" id="req1">Tato položka musí byť vyplnená.</p>
                            </div>
                            <div class="form-group">
                                <label for="title_en">* Anglický nadpis:</label>
                                <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $item->title_en }}" placeholder="Anglický nadpis" required />
                                <p class="required" id="req2">Tato položka musí byť vyplnená.</p>
                            </div>
                            <div class="form-group">
                                <label for="preview_sk">* Ukážkový text SK:</label>
                                <input type="text" class="form-control" id="preview_sk" name="preview_sk" value="{{ $item->preview_sk }}" placeholder="Slovenský preview text" required />
                                <p class="required" id="req3">Tato položka musí byť vyplnená.</p>
                            </div>
                            <div class="form-group">
                                <label for="preview_en">* Ukážkový text EN:</label>
                                <input type="text" class="form-control" id="preview_en" name="preview_en" value="{{ $item->preview_en }}" placeholder="Anglický preview text" required />
                                <p class="required" id="req4">Tato položka musí byť vyplnená.</p>
                            </div>
                            <div class="form-group">
                                <label for="orig_img">Ponechať obrázok:</label>
                                <input type="checkbox" id="orig_img" name="orig_img" value="set" checked />
                            </div>
                            @if($item->image_hash_name)
                                <div class="form-group">
                                    <label for="image">Ukážkový obrázok reupload:</label>
                                    <input type="file" id="image" name="image" />
                                </div>
                                <img src="{{ get_news_image($item->hash_id, $item->image_hash_name) }}" class="img-responsive" alt="news_image" width="300" height="300">
                            @else
                                <div class="form-group">
                                    <label for="image">Ukážkový obrázok:</label>
                                    <input type="file" class="form-control" id="image" name="image" />
                                </div>
                            @endif
                        </div>

                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group">
                                <label for="sk-editor">Dlhý text SK:</label>
                                <textarea class="form-control" rows="4" id="sk-editor" name="editor_content_sk">{{ $item->editor_content_sk }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="en-editor">Dlhý text EN:</label>
                                <textarea class="form-control" rows="4" id="en-editor" name="editor_content_en">{{ $item->editor_content_en }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="dropzone">Dodatočné súbory:</label>
                                <div class="dropzone" id="dropzone"></div>
                            </div>
                        </div>
                    </div>
                <div class="row text-center">
                    <input type="submit" class="btn btn-success" value="Ulož zmeny" />
                </div>
            </form>
            @if($add_files)
                @foreach($add_files as $added)
                    <div>
                        <p>{{ $added->file_name }}</p>
                        <a href="{{ url('/news-admin-delete-added/'.$added->nf_id) }}" class="btn btn-danger">Delete</a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@stop