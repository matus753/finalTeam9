@extends('base_structure')

@section('additional_headers')

<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style_projects.css') }}" rel="stylesheet">
@stop

@section('content')

<section class="banner" style="background-image: url('{{ URL::asset('images/banners/banner2.jpg') }}')">
	<h1>@lang('research::research.projects')</h1>
</section>
<p id='lang' style="display: none">@lang('research::research.lang')</p>
<div id="emPAGEcontent" class="container">
    <div class="container">
		<div class="row">
			<div >
				<div class="table-responsive">
					<table class="table">
						<thead class="category"><tr><th colspan="4">INTERNATIONAL</th></tr></thead>
						<thead>
							<tr class="tableHead">
								<th class="column1">@lang('research::research.projectNumber')</th>
								<th class="column2">@lang('research::research.projectTitle')</th>
								<th class="column3">@lang('research::research.projectDuration')</th>
								<th class="column4">@lang('research::research.projectCoordinator')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($international as $i)
                                <tr data-href="{{ url('/projects') }}/{{ $i->pr_id }}" data-id="{{$i->pr_id}}" class="m" data-toggle="collapse" data-target="#project{{$i->pr_id}}">
                                    <td class="column1">{{ $i->number }}</td>
                                    @if(session()->get('locale') === 'sk')
                                        <td class="column2"><span class="projectTitle sub{{$i->pr_id}}"> {{ $i->titleSK }}</span>
                                    @else
                                        <td class="column2"><span class="sub{{$i->pr_id}}"> {{ $i->titleEN }}</span>
                                            @endif
                                            <div class="collapse projectInfo" id="project{{$i->pr_id}}">
                                                @if($i->partners)
                                                    <p class="projectSubtitle">@lang('research::research.projectPartners')</p>
                                                    <p class="projectText">{{$i->partners}}</p>
                                                @endif
                                                @if($i->web)
                                                    <p class="projectSubtitle">@lang('research::research.projectWeb')</p>
                                                    <p class="projectText">{{$i->web}}</p>
                                                @endif
                                                @if($i->internalCode)
                                                    <p class="projectSubtitle">@lang('research::research.projectCode')</p>
                                                    <p class="projectText">{{$i->internalCode}}</p>
                                                @endif
                                                @if(session()->get('locale') === 'sk')
                                                    @if($i->annotationSK)
                                                        <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                        <p class="projectText" style="text-align: justify">{{$i->annotationSK}}</p>
                                                    @endif
                                                @else
                                                    @if($i->annotationEN)
                                                        <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                        <p class="projectText" style="text-align: justify">{{$i->annotationEN}}</p>
                                                    @endif
                                                @endif
                                            </div></td>
                                        <td class="column3">{{ $i->duration }}</td>
                                        <td class="column4">{{ $i->coordinator }}</td>
                                </tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">

					<table class="table">
                        <thead class="category"><tr><th colspan="4">KEGA</th></tr></thead>
						<thead>
							<tr class="tableHead">
								<th class="column1">@lang('research::research.projectNumber')</th>
								<th class="column2">@lang('research::research.projectTitle')</th>
								<th class="column3">@lang('research::research.projectDuration')</th>
								<th class="column4">@lang('research::research.projectCoordinator')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($kega as $k)
                                <tr data-href="{{ url('/projects') }}/{{ $k->pr_id }}" data-id="{{$k->pr_id}}" class="m" data-toggle="collapse" data-target="#project{{$k->pr_id}}">
                                    <td class="column1">{{ $k->number }}</td>
                                    @if(session()->get('locale') === 'sk')
                                        <td class="column2"><span class="projectTitle sub{{$k->pr_id}}"> {{ $k->titleSK }}</span>
                                    @else
                                        <td class="column2"><span class="sub{{$k->pr_id}}"> {{ $k->titleEN }}</span>
                                    @endif
                                    <div class="collapse projectInfo" id="project{{$k->pr_id}}">
                                        @if($k->partners)
                                            <p class="projectSubtitle">@lang('research::research.projectPartners')</p>
                                            <p class="projectText">{{$k->partners}}</p>
                                        @endif
                                        @if($k->web)
                                            <p class="projectSubtitle">@lang('research::research.projectWeb')</p>
                                            <p class="projectText">{{$k->web}}</p>
                                        @endif
                                        @if($k->internalCode)
                                            <p class="projectSubtitle">@lang('research::research.projectCode')</p>
                                            <p class="projectText">{{$k->internalCode}}</p>
                                        @endif
                                        @if(session()->get('locale') === 'sk')
                                            @if($k->annotationSK)
                                                <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                <p class="projectText" style="text-align: justify">{{$k->annotationSK}}</p>
                                            @endif
                                        @else
                                            @if($k->annotationEN)
                                                <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                <p class="projectText" style="text-align: justify">{{$k->annotationEN}}</p>
                                            @endif
                                        @endif
                                    </div></td>
                                    <td class="column3">{{ $k->duration }}</td>
                                    <td class="column4">{{ $k->coordinator }}</td>
                                </tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">
					<table class="table">
                        <thead class="category"><tr><th colspan="4">VEGA</th></tr></thead>
						<thead>
							<tr class="tableHead">
								<th class="column1">@lang('research::research.projectNumber')</th>
								<th class="column2">@lang('research::research.projectTitle')</th>
								<th class="column3">@lang('research::research.projectDuration')</th>
								<th class="column4">@lang('research::research.projectCoordinator')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($vega as $v)
                                <tr data-href="{{ url('/projects') }}/{{ $v->pr_id }}" data-id="{{$v->pr_id}}" class="m" data-toggle="collapse" data-target="#project{{$v->pr_id}}">
                                    <td class="column1">{{ $v->number }}</td>
                                    @if(session()->get('locale') === 'sk')
                                        <td class="column2"><span class="projectTitle sub{{$v->pr_id}}"> {{ $v->titleSK }}</span>
                                    @else
                                        <td class="column2"><span class="sub{{$v->pr_id}}"> {{ $v->titleEN }}</span>
                                            @endif
                                            <div class="collapse projectInfo" id="project{{$v->pr_id}}">
                                                @if($v->partners)
                                                    <p class="projectSubtitle">@lang('research::research.projectPartners')</p>
                                                    <p class="projectText">{{$v->partners}}</p>
                                                @endif
                                                @if($v->web)
                                                    <p class="projectSubtitle">@lang('research::research.projectWeb')</p>
                                                    <p class="projectText">{{$v->web}}</p>
                                                @endif
                                                @if($v->internalCode)
                                                    <p class="projectSubtitle">@lang('research::research.projectCode')</p>
                                                    <p class="projectText">{{$v->internalCode}}</p>
                                                @endif
                                                @if(session()->get('locale') === 'sk')
                                                    @if($v->annotationSK)
                                                        <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                        <p class="projectText" style="text-align: justify">{{$v->annotationSK}}</p>
                                                    @endif
                                                @else
                                                    @if($v->annotationEN)
                                                        <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                        <p class="projectText" style="text-align: justify">{{$v->annotationEN}}</p>
                                                    @endif
                                                @endif
                                            </div></td>
                                        <td class="column3">{{ $v->duration }}</td>
                                        <td class="column4">{{ $v->coordinator }}</td>
                                </tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">

					<table class="table">
                        <thead class="category"><tr><th colspan="4">APVV</th></tr></thead>
						<thead>
							<tr class="tableHead">
								<th class="column1">@lang('research::research.projectNumber')</th>
								<th class="column2">@lang('research::research.projectTitle')</th>
								<th class="column3">@lang('research::research.projectDuration')</th>
								<th class="column4">@lang('research::research.projectCoordinator')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($apvv as $a)
                                <tr data-href="{{ url('/projects') }}/{{ $a->pr_id }}" data-id="{{$a->pr_id}}" class="m" data-toggle="collapse" data-target="#project{{$a->pr_id}}">
                                    <td class="column1">{{ $a->number }}</td>
                                    @if(session()->get('locale') === 'sk')
                                        <td class="column2"><span class="projectTitle sub{{$a->pr_id}}"> {{ $a->titleSK }}</span>
                                    @else
                                        <td class="column2"><span class="sub{{$a->pr_id}}"> {{ $a->titleEN }}</span>
                                            @endif
                                            <div class="collapse projectInfo" id="project{{$a->pr_id}}">
                                                @if($a->partners)
                                                    <p class="projectSubtitle">@lang('research::research.projectPartners')</p>
                                                    <p class="projectText">{{$a->partners}}</p>
                                                @endif
                                                @if($a->web)
                                                    <p class="projectSubtitle">@lang('research::research.projectWeb')</p>
                                                    <p class="projectText">{{$a->web}}</p>
                                                @endif
                                                @if($a->internalCode)
                                                    <p class="projectSubtitle">@lang('research::research.projectCode')</p>
                                                    <p class="projectText">{{$a->internalCode}}</p>
                                                @endif
                                                @if(session()->get('locale') === 'sk')
                                                    @if($a->annotationSK)
                                                        <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                        <p class="projectText" style="text-align: justify">{{$a->annotationSK}}</p>
                                                    @endif
                                                @else
                                                    @if($a->annotationEN)
                                                        <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                        <p class="projectText" style="text-align: justify">{{$a->annotationEN}}</p>
                                                    @endif
                                                @endif
                                            </div></td>
                                        <td class="column3">{{ $a->duration }}</td>
                                        <td class="column4">{{ $a->coordinator }}</td>
                                </tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="table-responsive">

					<table class="table">
                        <thead class="category"><tr><th colspan="4">OTHER</th></tr></thead>
						<thead>
							<tr class="tableHead">
								<th class="column1">@lang('research::research.projectNumber')</th>
								<th class="column2">@lang('research::research.projectTitle')</th>
								<th class="column3">@lang('research::research.projectDuration')</th>
								<th class="column4">@lang('research::research.projectCoordinator')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($other as $o)
                                <tr data-href="{{ url('/projects') }}/{{ $o->pr_id }}" data-id="{{$o->pr_id}}" class="m" data-toggle="collapse" data-target="#project{{$o->pr_id}}">
                                    <td class="column1">{{ $o->number }}</td>
                                    @if(session()->get('locale') === 'sk')
                                        <td class="column2"><span class="projectTitle sub{{$o->pr_id}}"> {{ $o->titleSK }}</span>
                                    @else
                                        <td class="column2"><span class="sub{{$o->pr_id}}"> {{ $o->titleEN }}</span>
                                            @endif
                                            <div class="collapse projectInfo" id="project{{$o->pr_id}}">
                                                @if($o->partners)
                                                    <p class="projectSubtitle">@lang('research::research.projectPartners')</p>
                                                    <p class="projectText">{{$o->partners}}</p>
                                                @endif
                                                @if($o->web)
                                                    <p class="projectSubtitle">@lang('research::research.projectWeb')</p>
                                                    <p class="projectText">{{$o->web}}</p>
                                                @endif
                                                @if($o->internalCode)
                                                    <p class="projectSubtitle">@lang('research::research.projectCode')</p>
                                                    <p class="projectText">{{$o->internalCode}}</p>
                                                @endif
                                                @if(session()->get('locale') === 'sk')
                                                    @if($o->annotationSK)
                                                        <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                        <p class="projectText" style="text-align: justify">{{$o->annotationSK}}</p>
                                                    @endif
                                                @else
                                                    @if($o->annotationEN)
                                                        <p class="projectSubtitle">@lang('research::research.projectAnot')</p>
                                                        <p class="projectText" style="text-align: justify">{{$o->annotationEN}}</p>
                                                    @endif
                                                @endif
                                            </div></td>
                                        <td class="column3">{{ $o->duration }}</td>
                                        <td class="column4">{{ $o->coordinator }}</td>
                                </tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


</div>
<script type="text/javascript" src="{{ URL::asset('js/scripty_projects.js') }}" ></script>
@stop