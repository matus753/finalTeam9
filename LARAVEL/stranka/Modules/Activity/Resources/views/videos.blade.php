@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/activity.css') }}" rel="stylesheet">
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
            content.innerHTML += '<p><i class="fa fa-youtube-play" aria-hidden="true"></i><a href="' + videos[v].url + '">' + videos[v].title_SK + '</a></p>';
        }
    }
	
</script>
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner12.png') }}')">
    <h1>Videá</h1>
</section>
<div id="emPAGEcontent" class="container">
	<select id="videos_cats" class="soflow" onchange="change_videos_cats(this)">
		<option value="all">Všetky</option>
		@foreach($videos_cats as $v)
			<option value="{{ $v->type }}">{{ $v->type }}</option>
		@endforeach
	</select>
	
	<div class="video-content" id="links">

	</div>
</div>    
@stop