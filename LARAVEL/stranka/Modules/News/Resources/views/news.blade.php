@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/ib_style.css') }}" rel="stylesheet">
@stop

@section('content')
<script>
$(document).ready(function(){
	var filt = $('#ib-news-select').val();
	var checked;
	if($('#ib-news-chb').attr('checked')){
		checked = 1;
	}
	else{
		checked = 0;
	}
});

function selected_data(){
	var filt = $('#ib-news-select').val();
	var checked;
	if($('#ib-news-chb').prop('checked')){
		checked = 1;
	}
	else{
		checked = 0;
	}
}

function check(){
	var filt = $('#ib-news-select').val();
	var checked;
	if($('#ib-news-chb').prop('checked')){
		checked = 1;
	}
	else{
		checked = 0;
	}
}

</script>

<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner4.jpg') }}')">
	<h1>Aktuality</h1>
</section>
<div id="emPAGEcontent" class="container">
	<div class="row" style="margin-bottom: 10px">
		<div class="ib-inline ib-left">
			<div class="ib-in">
				<button type='button' class='btn  ib-add' data-toggle='modal' data-target='#newsletter'>Newsletter TODO</button>
			</div>
			<p>Q: to do neverending expiration?</p>
		</div>
		
		<div class="ib-inline ib-right">
			<form method="GET" action="{{ url('/news') }}" >
			Typ:
			<select id="ib-news-select" name="type" onchange="this.form.submit()" >
				<option value="0" @if($type == 0) {{ 'selected' }} @endif>Propagácia</option>
				<option value="1" @if($type == 1) {{ 'selected' }} @endif>Oznamy</option>
				<option value="2" @if($type == 2) {{ 'selected' }} @endif>Zo života ústavu</option>
				<option value="-1" @if($type == -1) {{ 'selected' }} @endif>Všetky</option>
			</select>
			Expirované:
			<input id="ib-news-chb" type="checkbox" name="expired" @if($expired) {{ 'checked' }} @endif onchange="this.form.submit()" >
			</form>
		</div>
	</div>

    <div class="row" >
        <div class="col-md-12" id="news-content">
			@if($news)
				{!! $news->appends(Request::input())->render() !!}
				@foreach($news as $n)
					<div class="row" style="margin: 1em; background-color: grey;">
						<div class="col-md-12">
							<div class="col-md-3">
								<img src="{{ get_news_image($n->hash_id, $n->image_hash_name) }}" alt="image" height="120">
							</div>
							<div class="col-md-9">
								<h4>{{ $n->title_sk }}</h4>
								<p>{{ $n->preview_sk }}</p>
								@if($n->editor_content_sk)
									<a href="{{ url('/news/content/'.$n->id) }}" class="btn btn-primary">Read more</a>
								@endif
								<h5>Expirácia: {{ $n->date_expiration }}</h5>
							</div>
						</div>
					</div>
				@endforeach
				{!! $news->appends(Request::input())->render() !!}
			@else
				<div class="text-center">
					<h3>Žiadne aktuality</h3>
				</div>
			@endif
        </div>
	</div>
</div>   

<div id="newsletter" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="span5">
            <div class="thumbnail center well well-small text-center">
                <h2>Newsletter</h2>
                <div id="ib-newsletter-modal-body">
                    <p>Zadajte svoju emailovú adresu a prihláste sa na odoberanie noviniek</p>
                    <div class="input-prepend"><span class="add-on"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="email" data-error="Nesprávna emailová adresa" required id="ib-newsletter-email" name="" placeholder="your@email.com">
						<select id="ib-newsletter-select">
							<option value="SK" >SK</option>
							<option value="EN" >EN</option>
						</select>
                    </div>
                    <br />
                    <input id="1"  type="submit" value="Prihlásiť sa" class="btn btn-large" onclick="optin_yes()" />
                    <input id="0"  type="submit" value="Odhlásiť sa" class="btn btn-large" onclick="optin_no()" />
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	/*
function optin_yes(){
	var nl_mail = $('#ib-newsletter-email').val();
	var nl_lang = $('#ib-newsletter-select').val();
	var subscribe = 1;
	var data = { 'mail': nl_mail, 'lang': nl_lang, 'sub': subscribe };
	$.ajax({
		url:"{{ url('/news/optin') }}", 
		type: 'POST' , 
		data : data, 
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success : function(data){
			console.log(data);
		}
	});
}

function optin_no(){
	var nl_mail = $('#ib-newsletter-email').val();
	var nl_lang = $('#ib-newsletter-select').val();
	var subscribe = 0;
	var data = { 'mail': nl_mail, 'lang': nl_lang, 'sub': subscribe };
	$.ajax({
		url:"{{ url('/news/optin') }}", 
		type: 'POST' , 
		data : data, 
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success : function(data){
			console.log(data);
		}
	});
}
*/
</script>
@stop

