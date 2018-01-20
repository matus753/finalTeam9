@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content')
<script>
var table_pubs;
var table_content;

function showPubs(){
	var data = { 'ais_id' : {{ $ais_id }} };
	$.ajax({
		url:"{{ url('/staff/ajax_publications') }}", 
		type: 'POST' , 
		data : data, 
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success : function(data){
			var jsonObject = JSON.parse(data);
			if(data){
				$('#publications_table').removeClass('hidden');
			}
			$('#publications_table').DataTable({
				data: jsonObject,
				columns : [
						{"data" : "content"},
						{"data" : "type"},
						{"data" : "year"}        
				]
			});
		}
	});
}

</script>
<section class="banner banner--big" style="background-image: url('{{ URL::asset('images/banners/banner2.jpg') }}')">

</section>
<section class="staff-profile">
	<div class="container">
		<div class="staff-profile__content">
			<div class="staff-profile__info">
				<div class="row">
					@if( $ais->photo )
					<div class="col-sm-4 staff-profile__img">
						<img src="{{ URL::asset('images/staffPhoto') }}/{{ $ais->photo }}" alt="{{ $ais->photo }}">
					</div>
					<div class="col-sm-offset-1 col-sm-7">
					@else
					<div class="col-sm-offset-2 col-sm-8">
					@endif					
						<a href="{{ url('/staff') }}" class="staff-profile__back"><i class="fa fa-arrow-left"></i>@lang('staff::staff.back')</a>
						<h2>{{ $ais->title1 }} {{ $ais->name }} <b>{{ $ais->surname }}</b>, {{ $ais->title2 }}</h2>
						<span class="staff-profile__role">{{ $ais->staffRole }}</span>
						<hr>
						<div class="staff-profile__description">
							<p><span>@lang('staff::staff.room'): </span>{{ $ais->room }}</p>
							<p><span>@lang('staff::staff.phone'): </span>+421 60291 {{ $ais->phone }}</p>
							<p><span>@lang('staff::staff.department'): </span><?php echo fullDepartmentName($ais->department); ?></p>
							@if( $ais->function ) 
								<p><span>@lang('staff::staff.function'): </span>{{ $ais->function }}</p>
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="staff-profile__contact">
				<div class="staff-profile__links">
					<?php 
						if (empty($ais->email)) { 
							$staffEmail = $ais->name . "." . $ais->surname . "@stuba.sk";
						} 
						else {
							$staffEmail = $ais->email;
						}
						$staffEmail = remove_accents($staffEmail);
						$staffEmail = strtolower($staffEmail);
					?>
					<a href="mailto:{{ $staffEmail }}"><i class="fa fa-envelope" aria-hidden="true"></i> {{ $staffEmail }}</a>
					@if( $ais->web ) 
					<a href="https://{{ $ais->web }}" target="_blank"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{ $ais->web }}</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>

<section class="staff-publications">
	<div class="staff-publications__button">
		@if( $ais->ldapLogin )
		<button onclick="showPubs()">@lang('staff::staff.show_publications')</button>
		@else
		<br>
		@endif
	</div>
</section>

<section class="staff"  >
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="publications_table" class="table table-stripped table-bordered hidden" id="staff">
						<thead>
							<tr>
								<th>@lang('staff::staff.tbl-title')</th>
								<th>@lang('staff::staff.type')</th>
								<th>@lang('staff::staff.year')</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
	function fullDepartmentName($string) {
	    $departments = array(
		    'AHU' => 'Administratívno - hospodársky úsek',
		    'OAMM' => 'Oddelenie aplikovanej mechaniky a mechatroniky', 
		    'OEAP' => 'Oddelenie E-mobility, automatizácie a pohonov', 
		    'OEMP' => 'Oddelenie elektroniky, mikropočítačov a PLC systémov', 
		    'OIKR' => 'Oddelenie informačných, komunikačných a riadiacich systémov' 
	    );
		$string = strtr($string, $departments);

	    return $string;
	}

	function remove_accents($string) {
	    if ( !preg_match('/[\x80-\xff]/', $string) )
	        return $string;

	    $chars = array(
		    chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
		    chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
		    chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
		    chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
		    chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
		    chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
		    chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
		    chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
		    chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
		    chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
		    chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
		    chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
		    chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
		    chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
		    chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
		    chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
		    chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
		    chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
		    chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
		    chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
		    chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
		    chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
		    chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
		    chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
		    chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
		    chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
		    chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
		    chr(195).chr(191) => 'y',
		    // Decompositions for Latin Extended-A
		    chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
		    chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
		    chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
		    chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
		    chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
		    chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
		    chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
		    chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
		    chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
		    chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
		    chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
		    chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
		    chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
		    chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
		    chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
		    chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
		    chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
		    chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
		    chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
		    chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
		    chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
		    chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
		    chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
		    chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
		    chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
		    chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
		    chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
		    chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
		    chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
		    chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
		    chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
		    chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
		    chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
		    chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
		    chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
		    chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
		    chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
		    chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
		    chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
		    chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
		    chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
		    chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
		    chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
		    chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
		    chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
		    chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
		    chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
		    chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
		    chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
		    chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
		    chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
		    chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
		    chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
		    chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
		    chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
		    chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
		    chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
		    chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
		    chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
		    chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
		    chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
		    chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
		    chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
		    chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
	    );
		$string = strtr($string, $chars);
	    $string = strtolower($string);

	    return $string;
	}
?>

@stop
