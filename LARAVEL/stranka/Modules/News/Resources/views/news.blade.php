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
	var data = { 'type':filt , 'exp': checked }
	console.log(data);
	$.ajax({
		url:"{{ url('/news/filter') }}", 
		type: 'POST' , 
		data : data, 
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success : function(data){
			console.log(data);
		}
	});
});

function filter(){
	var filt = $('#ib-news-select').val();
	var checked;
	if($('#ib-news-chb').prop('checked')){
		checked = 1;
	}
	else{
		checked = 0;
	}
	var data = { 'type':filt , 'exp': checked }
	console.log(data);
	$.ajax({
		url:"{{ url('/news/filter') }}", 
		type: 'POST' , 
		data : data, 
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success : function(data){
			console.log(data);
		}
	});
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
	var data = { 'type':filt , 'exp': checked }
	console.log(data);
	$.ajax({
		url:"{{ url('/news/filter') }}", 
		type: 'POST' , 
		data : data, 
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success : function(data){
			console.log(data);
		}
	});
}

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


</script>
<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner4.jpg') }}')">
	<h1>Aktuality</h1>
</section>
<div id="emPAGEcontent" class="container">
        <div class="row" style="margin-bottom: 10px">
            <div class="ib-inline ib-left">
                <div class="ib-in">
                    <h3>Aktuality</h3>
                </div>
                <div class="ib-in">
                    <button type='button' class='btn  ib-add' data-toggle='modal' data-target='#newsletter'>Newsletter TODO</button>
                </div>
            </div>
            <div class="ib-inline ib-right">
                Typ:
                <select id="ib-news-select" onchange="filter()" >
                    <option value="0" >Propagácia</option>
                    <option value="1" >Oznamy</option>
                    <option value="2" >Zo života ústavu</option>
                    <option value="-1" selected>Všetky</option>
                </select>

                Expirované:
                <input id="ib-news-chb" type="checkbox" onchange="check()" >
            </div>
			cez AJAX ti prichadzaju data
        </div>

    <div class="row" id="news-content">
        <div class="col-md-12">

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
 
@stop
