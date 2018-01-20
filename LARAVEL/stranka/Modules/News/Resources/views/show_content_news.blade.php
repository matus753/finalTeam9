@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/ib_style.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner4.jpg') }}')">
	<h1>Aktuality</h1>
</section>
<div id="emPAGEcontent" class="container">
    {{ $content->title_sk }}<br>
    {!! $content->editor_content_sk !!}<br>
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
