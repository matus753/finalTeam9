@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/activity.css') }}" rel="stylesheet">
<script type="text/javascript"  src="{{URL::asset('js/galleries/activity.js')}}"></script>
@stop

@section('content')
<script>
	$(document).ready(function() {
		var sel = $('#videos_cats').val();
		var data = { 'category' : sel };
		$.ajax({
			url:"{{ url('/videos/filter') }}", 
			type: 'POST', 
			data : data, 
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			success : function(data){
                showData(data);
			}
		});
	});
	
	function change_videos_cats(s){
		var sel = s.value;
		var data = { 'category' : sel };
		$.ajax({
			url:"{{ url('/videos/filter') }}", 
			type: 'POST', 
			data : data, 
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			success : function(data){
				showData(data);
			}
		});
	}

	function showData(data) {
		var videos = JSON.parse(data);
        var content = document.getElementById('links');
        content.innerHTML = '';
        for(v in videos){
            content.innerHTML += '<div class="row video"><div class="col-xs-3"> <button type="button" class="btn video-btn" data-toggle="modal" data-src="' + videos[v].url + '" data-target="#myModal"><i class="fa fa-youtube-play" aria-hidden="true"></i>YouTube</button></div><div class="col-xs-9"> ' + videos[v].title + '</div></div>';
        }
    }
	
</script>
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner12.png') }}')">
    <h1>@lang('activity::activity.videos')</h1>
</section>
<div id="emPAGEcontent" class="container">
	<select id="videos_cats" class="soflow" onchange="change_videos_cats(this)">
		<option value="all">@lang('activity::activity.all')</option>
		@foreach($videos_cats as $v)
			<option value="{{ $v->type }}">{{ $v->type }}</option>
		@endforeach
	</select>
	
	<div class="video-content" id="links" style="padding: 2em;">

	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<!-- 16:9 aspect ratio -->
					<div class="embed-responsive embed-responsive-16by9">
						<iframe width="420" height="315" class="embed-responsive-item" src="" id="video" frameborder="0" allowscriptaccess="always" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop