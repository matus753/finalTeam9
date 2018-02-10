@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>

<script src="{{ URL::asset('plugins/dropzone/dropzone.js') }}"></script>
<link href="{{ URL::asset('plugins/dropzone/dropzone.css') }}" rel="stylesheet">
@stop

@section('content_admin')
<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('/photos-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Pridanie obrázkov do galérie</h3>
                    </div>
                </div>
            </div>
            <br>
            <label for="title_sk">Slovenský nadpis galérie:</label>
            <span id="title_sk">{{ $gallery->title_SK }}</span>
            <br>
            <label for="title_en">Anglický nadpis galérie:</label>
            <span id="title_en">{{ $gallery->title_EN }}</span>
            <br>
            <a href="{{ url('/photos-admin') }}" class="btn btn-primary"> Pridaj obrázky neskôr </a>
            <br>
            <br>
            <br>
            <div class="dropzone" id="dropzone"></div>
		</div>
	</div>

</div> 

<script>
    $(document).ready(function(){
        Dropzone.autoDiscover = false; // autosearch for div
		var myDropzone = new Dropzone("div#dropzone", 
			{ 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				url : "{{ url('/photos-admin-upload-action') }}",
				thumbnailWidth: 360, 
				thumbnailHeight: 360, 
				thumbnailMethod: 'crop',
				timeout: 9900000,
				uploadMultiple: true,
                autoProcessQueue: true,
                init: function() {
                    this.on("sending", function(file, xhr, formData){
                            formData.append("hash_check", "{{ $gallery->folder }}");
                            formData.append("id", "{{ $gallery->pg_id }}");
                    });
                }
			}
		);
    });
</script>
@stop