@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/style_index.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
 <div id="emPAGEcontent">        
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
				<div class="item active">
					<img src="{{ URL::asset('images/indexPhoto/slider2.jpg') }}" alt="UAMT" width="100%">
					<div class="carousel-caption">
						<p class="slider-text">@lang('home::home.slider1')</p>
					<h3 class="slider-h3 slider-bg-white">@lang('home::home.slider1_highlighted')</h3>                     
					</div>      
				</div>

				<div class="item">
					<img src="{{ URL::asset('images/indexPhoto/slider3.jpg') }}" alt="UAMT" width="100%">
					<div class="carousel-caption">
					<h3 class="slider-h3 slider-bg-white">@lang('home::home.slider2_highlighted')</h3>
					<p class="slider-text">@lang('home::home.slider2')</p>
					</div>      
				</div>

				<div class="item">
					<img src="{{ URL::asset('images/indexPhoto/slider1.jpg') }}" alt="UAMT" width="100%">
					<div class="carousel-caption">
					<h3 class="slider-h3 slider-bg-black">@lang('home::home.slider3_highlighted')</h3>
					<p class="slider-text">@lang('home::home.slider3')<a href="http://www.automobilova-mechatronika.fei.stuba.sk/webstranka/" class="slider-a">@lang('home::home.slider3_link')</a></p>
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
		
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row thumb-fb-row">
						<div class="col-sm-6 col-md-3">
						  <div class="thumbnail thumbfb">
							<img src="{{ URL::asset('images/indexPhoto/t1.JPG') }}" alt="...">
							<div class="caption">
							  <h3>@lang('home::home.about_us')</h3>
							  <p>@lang('home::home.about_us_section_preview')</p>
							  <p><a href="aboutUs.php" class="btn btn-default btn-dark-blue" role="button">@lang('home::home.about_us')</a> <a href="staff.php" class="btn btn-default btn-blue" role="button">@lang('home::home.staff')</a></p>
							</div>
						  </div> 
						</div>
						  <div class="col-sm-6 col-md-3">
						  <div class="thumbnail thumbfb">
							<img src="{{ URL::asset('images/indexPhoto/t2.JPG') }}" alt="...">
							<div class="caption">
							  <h3>@lang('home::home.news')</h3>
							  <p>@lang('home::home.news_section_preview')<p>
							  <p><a href="news.php" class="btn btn-default btn-dark-blue" role="button">@lang('home::home.news')</a>
							</div>
						  </div>
						</div>
						<div class="col-sm-6 col-md-3">
						  <div class="thumbnail thumbfb">
							<img src="{{ URL::asset('images/indexPhoto/t3.JPG') }}" alt="...">
							<div class="caption">
							  <h3>@lang('home::home.photo_gallery')</h3>
							  <p>@lang('home::home.photo_gallery_section_preview')</p>
							  <p><a href="photo.php" class="btn btn-default btn-dark-blue" role="button">@lang('home::home.photo_gallery')</a> <a href="video.php" class="btn btn-default btn-blue" role="button">@lang('home::home.videos')</a></p>
							</div>
						  </div>
						</div>
						<div class="col-sm-6 col-md-3">                          
							<div id="fb-root"></div>
								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = "//connect.facebook.net/sk_SK/sdk.js#xfbml=1&version=v2.9";
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));
								</script>
							<div class="fb-page" data-href="https://www.facebook.com/UAMTFEISTU/?fref=ts" data-tabs="timeline" data-height="430" data-width="320" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
								<blockquote cite="https://www.facebook.com/UAMTFEISTU/?fref=ts" class="fb-xfbml-parse-ignore">
									<a href="https://www.facebook.com/UAMTFEISTU/?fref=ts">Ústav automobilovej mechatroniky FEI STU</a>
								</blockquote>
							</div>
					   </div>
					</div>
					<!-- Container (Services Section) -->
					<div class="container-fluid text-center">
					  <h2 class="bold">@lang('home::home.offering')</h2>
					  <br>
					  <div class="row">                        
						<div class="col-sm-4">
						  <span class="fa fa-graduation-cap fa-3x" style="color: #4da6ff;"></span>
						  <h4>@lang('home::home.dis_master_study')</h4>
						  <p class="con-text">@lang('home::home.dis_master_study_text')</p>
						</div>
						<div class="col-sm-4">
						  <span class="fa fa-certificate fa-3x" style="color: #4da6ff;"></span>
						  <h4>@lang('home::home.quality_of_studies')</h4>
						  <p class="con-text">@lang('home::home.quality_of_studies_text')</p>
						</div>
						<div class="col-sm-4">
						  <span class="fa fa-cog fa-3x" style="color: #4da6ff;"></span>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
