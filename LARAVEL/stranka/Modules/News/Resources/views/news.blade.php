@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/ib_style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">

<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/activity.css') }}" rel="stylesheet">

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
	<h1>@lang("news::news.title")</h1>
</section>
<div id="emPAGEcontent" class="container">
	<div class="row" style="margin-bottom: 30px">
		<div class="col-md-6">
			<div class="">
				<button type='button' class='btn  ib-add' data-toggle='modal' data-target='#newsletter'>@lang("news::news.newsletter")</button>
			</div>
		</div>
		
		<div class="col-md-6">
            <form class="form-inline" method="GET" action="{{ url('/news') }}" >
                <div class="form-group">
                    <label for="type_sel">Type:</label>
                    <select class="form-control" id="type_sel" name="type" onchange="this.form.submit()">
                        <option value="0" @if($type == 0) {{ 'selected' }} @endif>@lang("news::news.prop")</option>
                        <option value="1" @if($type == 1) {{ 'selected' }} @endif>@lang("news::news.notice")</option>
                        <option value="2" @if($type == 2) {{ 'selected' }} @endif>@lang("news::news.life")</option>
                        <option value="-1" @if($type == -1) {{ 'selected' }} @endif>@lang("news::news.all")</option>
                    </select>
                </div>
                <div class="checkbox">
                    <label> @lang("news::news.expired"):
                    <input id="ib-news-chb" type="checkbox" name="expired" @if($expired) {{ 'checked' }} @endif onchange="this.form.submit()" >
                    </label>
                </div>
			</form>
		</div>
	</div>

    <div class="row" style="margin-bottom: 50px;">
        @if($news)
            {!! $news->appends(Request::input())->render() !!}
            @foreach($news as $n)
                <div class="row carousel-row img-rounded {{ $today > $n->date_expiration ? 'expired' : '' }}">
                    <div class="col-md-12">
                        <div class="col-md-2">
                                        <img src="{{ get_news_image($n->hash_id, $n->image_hash_name) }}" alt="Image" height="240">

                        </div>
                        <div class="col-md-8">
                            <div id="carousel-1" class="carousel " data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <h4>{{ $n->title_sk }}</h4>
                                <p>
                                    {{ $n->preview_sk }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 60px; margin-bottom: 10px;">
                            @if($n->editor_content_sk)
                                <a class="btn btn-sm btn-default ib-button" href="{{ url('/news/content/'.$n->id) }}"><i class="fa fa-fw fa-eye"></i> @lang("news::news.more")</a>
                            @endif
                            <button class="btn btn-sm btn-primary {{ $today > $n->date_expiration ? 'expired_b' : '' }} ib-button"><i class="fa fa-fw fa-shopping-cart"></i> @lang("news::news.created"): {{ format_time($n->date_created) }}</button>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $news->appends(Request::input())->render() !!}
        @else
            <div class="text-center">
                <h3>@lang("news::news.no_news")</h3>
            </div>
        @endif
    </div>

</div>

<div id="newsletter" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="span5">
            <div class="thumbnail center well well-small text-center">
                <h2>@lang("news::news.newsletter")</h2>
                <div id="ib-newsletter-modal-body">
                    <p>@lang("news::news.enter_mail")</p>
                    <div class="input-prepend"><span class="add-on"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="email" data-error="@lang('news::news.newsletter')" required id="ib-newsletter-email" name="" placeholder="your@email.com">
						<select id="ib-newsletter-select">
							<option value="SK" >SK</option>
							<option value="EN" >EN</option>
						</select>
                    </div>
                    <br />
                    <input id="1"  type="submit" value="@lang('news::news.subscribe')" class="btn btn-large" onclick="optin(1)" />
                    <input id="0"  type="submit" value="@lang('news::news.unsubscribe')" class="btn btn-large" onclick="optin(0)"/>
                    <div id="response"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function optin(toggle){
        // data-dismiss="modal"
        var mail = $('#ib-newsletter-email').val();
        var lang = $('#ib-newsletter-select').val();
        var data = { 'toggle' : toggle, 'mail' : mail, 'lang' : lang };
        $.ajax({
            url: "{{ url('/news/optin') }}",
            data: data,
            type: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).done(function(data){
            $('#response').empty().append('<p>'+JSON.parse(data)+'</p>');
            setTimeout(function(){
                $('#newsletter').modal('toggle');
            }, 1500);
        }).fail(function(data){
            $('#response').empty().append('<p>'+JSON.parse(data)+'</p>');
        });
    }
</script>
@stop

