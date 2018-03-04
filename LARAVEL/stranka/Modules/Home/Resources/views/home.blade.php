@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/style_index.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/jquery-ui.js') }}"></script>
<link href="{{ URL::asset('css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/homepage.js') }}"></script>  
<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">  
<script src="{{ URL::asset('js/dateformat-min.js') }}"></script>  
@stop

@section('content')      
<div class="carousel-item">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
		  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		  <li data-target="#myCarousel" data-slide-to="1"></li>
		  <li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			
			<div class="item active" style="background-image: url('{{ URL::asset('images/indexPhoto/slider2.jpg') }}')">
				<div class="carousel-caption">
					<p class="slider-text">@lang('home::home.slider1')</p>
					<h3 class="slider-h3 slider-bg-white">@lang('home::home.slider1_highlighted')</h3>                     
				</div>      
			</div>
			<div class="item" style="background-image: url('{{ URL::asset('images/indexPhoto/slider3.jpg') }}')">
				<div class="carousel-caption">
					<h3 class="slider-h3 slider-bg-white">@lang('home::home.slider2_highlighted')</h3>
					<p class="slider-text">@lang('home::home.slider2')</p>
				</div>      
			</div>
			<div class="item" style="background-image: url('{{ URL::asset('images/indexPhoto/slider1.jpg') }}')">
				<div class="carousel-caption">
					<h3 class="slider-h3 slider-bg-black">@lang('home::home.slider3_highlighted')</h3>
					<p class="slider-text"><a href="http://www.automobilova-mechatronika.fei.stuba.sk/webstranka/" class="slider-a" target="_blank">@lang('home::home.slider3')<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></p>
				</div>      
			</div>
		</div>
		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span id="carousel-left-arrow" class="fa fa-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span id="carousel-right-arrow" class="fa fa-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
	
	<div class="container">
		<div class="row"> 
			<div class="col-lg-12">
				<div class="row thumb-fb-row hp-thumbnail">
					<div class="col-sm-4 col-md-3">
					  <div class="hp-thumbnail__wrapper">
						  <a class="hp-thumbnail__item" style="background-image: url({{ URL::asset('images/indexPhoto/t1.JPG') }})" href="management">
						  	<div class="hp-thumbnail__item-content">
						  		<h3>@lang('home::home.about_us')</h3>
						  		<p class="hp-thumbnail__text">@lang('home::home.about_us_section_preview')</p>
						  		<p class="hp-thumbnail__link">Prejdite na stránku <i class="fa fa-arrow-right" aria-hidden="true"></i></p>
						  	</div>
						  </a>
					</div>
				  </div>
				  <div class="col-sm-4 col-md-3">
					  <div class="hp-thumbnail__wrapper">
						  <a class="hp-thumbnail__item" style="background-image: url({{ URL::asset('images/indexPhoto/t2.JPG') }})" href="news">
						  	<div class="hp-thumbnail__item-content">
						  		<h3>@lang('home::home.news')</h3>
						  		<p class="hp-thumbnail__text">@lang('home::home.news_section_preview')</p>
						  		<p class="hp-thumbnail__link">Prejdite na stránku <i class="fa fa-arrow-right" aria-hidden="true"></i></p>
						  	</div>
						  </a>
					  </div>
				  </div>
				  <div class="col-sm-4 col-md-3">
					  <div class="hp-thumbnail__wrapper">
						  <a class="hp-thumbnail__item" style="background-image: url({{ URL::asset('images/indexPhoto/t3.JPG') }})" href="photo-gallery">
						  	<div class="hp-thumbnail__item-content">
						  		<h3>@lang('home::home.photo_gallery')</h3>
						  		<p class="hp-thumbnail__text">@lang('home::home.photo_gallery_section_preview')</p>
						  		<p class="hp-thumbnail__link">Prejdite na stránku <i class="fa fa-arrow-right" aria-hidden="true"></i></p>
						  	</div>
						  </a>
					  </div>
				  </div>
				  <div class="col-sm-12 col-md-3">                          
						<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/sk_SK/sdk.js#xfbml=1&version=v2.9";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));
							</script>
						<div class="fb-page" data-href="https://www.facebook.com/UAMTFEISTU/?fref=ts" data-tabs="timeline" data-height="430" data-width="1000000000" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
							<blockquote cite="https://www.facebook.com/UAMTFEISTU/?fref=ts" class="fb-xfbml-parse-ignore">
								<a href="https://www.facebook.com/UAMTFEISTU/?fref=ts">Ústav automobilovej mechatroniky FEI STU</a>
							</blockquote>
						</div>
				   </div>
				</div>
				<!-- Container (Services Section) -->
<!-- 					<div class="container-fluid text-center hp-benefits">
				  <h2 class="bold">@lang('home::home.offering')</h2>
				  <br>
				  <div class="row">                        
					<div class="col-sm-4">
					  <span class="fa fa-graduation-cap hp-benefits__icon" style="color: #4da6ff;"></span>
					  <h4>@lang('home::home.dis_master_study')</h4>
					  <p class="con-text">@lang('home::home.dis_master_study_text')</p>
					</div>
					<div class="col-sm-4">
					  <span class="fa fa-certificate hp-benefits__icon" style="color: #4da6ff;"></span>
					  <h4>@lang('home::home.quality_of_studies')</h4>
					  <p class="con-text">@lang('home::home.quality_of_studies_text')</p>
					</div>
					<div class="col-sm-4">
					  <span class="fa fa-cog hp-benefits__icon" style="color: #4da6ff;"></span>
					  <h4>@lang('home::home.interesting_projects')</h4>
					  <p class="con-text">@lang('home::home.interesting_projects_text')</p>
					</div>
				  </div>
				</div>
				<div class="row video-index">  
					<div class="col-md-3"> 
					</div>
					<div class="col-md-6 col-xs-12">                    
						<iframe width="100%" height="320px" src="https://www.youtube.com/embed/vCYq4JspSCI" frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="col-md-3"> 
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<script type="text/javascript">
		
		$( function() {
		      $.datepicker.regional['sk'] = {
		            closeText: 'Zavrieť',
		            prevText: '<Predchádzajúci',
		            nextText: 'Nasledujúci>',
		            currentText: 'Dnes',
		            monthNames: ['Január','Február','Marec','Apríl','Máj','Jún',
		            'Júl','August','September','Október','November','December'],
		            monthNamesShort: ['Jan','Feb','Mar','Apr','Máj','Jún',
		            'Júl','Aug','Sep','Okt','Nov','Dec'],
		            dayNames: ['Nedel\'a','Pondelok','Utorok','Streda','Štvrtok','Piatok','Sobota'],
		            dayNamesShort: ['Ned','Pon','Uto','Str','Štv','Pia','Sob'],
		            dayNamesMin: ['Ne','Po','Ut','St','Št','Pia','So'],
		            weekHeader: 'Ty',
		            dateFormat: 'dd.mm.yy',
		            firstDay: 0,             
		            isRTL: false,
		            showMonthAfterYear: false,
		            yearSuffix: ''
		      };
		    var $result = $("#special");
		    var datavalues = {
		    	"" : ""
		    	@foreach($events as $e)
		  			, "{{ format_time($e->date) }}": "{{ $e->name_sk }}"
		  		@endforeach
			};
			var eventsDays = [ "05.03.2018"
			];

			if ($( window ).width() > 767) {
      			var displayMonths =  2;
      		}
      		else {
      			var displayMonths =  1;
      		}

			$.datepicker.setDefaults($.datepicker.regional['sk']);
		      $( "#datepicker" ).datepicker( {
		      		numberOfMonths: displayMonths,
		      		dateFormat: 'mm.dd.yy',
		      		beforeShowDay: function (date) {
	      			 var m = date.getMonth(), 
			             d = date.getDate(), 
			             y = date.getFullYear();
			         var a = d+"."+m+"."+y;
                    if ($.inArray(a, eventsDays) > -1) {
                        return [true, "event", dayTitle];
                    }
                    else {
                        return [false, '', ""];
                    }
                },
		      } );
		} );
	</script>
	<section class="hp-events">
		<div class="container">
			<div class="row"> 
				<div class="col-md-7 col-sm-8">
					<h4>Ústavný kalendár akcií</h4>
					<div id="datepicker" class="hp-events__datepicker"></div>
				</div>
				<div class=" col-md-offset-1 col-sm-4">
					<div class="hp-events__list">
						@php	
							$maxEvents = 0;
						@endphp
						@foreach($events as $e)
							@if ((getMonth(date("d.m.Y")) <= getMonth(format_time($e->date))) && (getYear(date("d.m.Y")) <= getYear(format_time($e->date))))
							    <h4>@if ($e->url) <a href="{{ $e->url }}" target="_blank"> @endif {{  $e->name_sk }} @if ($e->text_sk)<i data-toggle="tooltip" data-placement="top" title="{{  $e->text_sk }}" class="fa fa-info-circle"></i> @endif	@if ($e->url) </a> @endif</h4> 
								<p>{{  format_time($e->date) }} 
									@if ($e->time), {{  $e->time }} @endif 
									@if ($e->place), {{  $e->place }} @endif
								</p>	
								@php
									if ($maxEvents > 2) {
										break;
									}
									$maxEvents++;
								@endphp	
							@endif												
						@endforeach
					</div>
				</div>
			</div>
		</div>			  
	</section>
</div>
@stop
