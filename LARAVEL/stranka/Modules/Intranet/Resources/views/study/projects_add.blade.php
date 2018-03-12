@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content_admin')
    <script>
        function validateForm() {
            var x = document.forms["projectForm"]["id_number"].value;
            var y = document.forms["projectForm"]["title_sk"].value;
            if (!x.trim()) {
                $("#req1").css("display", "block");
                event.preventDefault();
            } else {
                $("#req1").css("display", "none");
            }

            if (!y.trim()) {
                $("#req2").css("display", "block");
                event.preventDefault();
            } else {
                $("#req2").css("display", "none");
            }
        }
    </script>
<div class="container">
    <div class="intra-div">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="pull-left">
                    <a href="{{ url('/projects-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                </div>
                <h2>Pridanie nového projektu</h2>
            </div>
        </div>

            <form name="projectForm" action="{{ url('/projects-admin-add-action') }}" method="post" onsubmit="validateForm()">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                        <div class="form-group">
                            <label for="role">* Typ:</label>
                            <select class="form-control" name="type">
                                @foreach($types as $t)
                                    <option value="{{ $t }}">{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_number">* ID číslo:</label>
                            <input type="text" class="form-control" id="id_number" name="id_number" placeholder="ID číslo" required />
                            <p class="required" id="req1">Tato položka musí byť vyplnená.</p>
                        </div>
                        <div class="form-group">
                            <label for="title_sk">* Slovenský nadpis:</label>
                            <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" required />
                            <p class="required" id="req2">Tato položka musí byť vyplnená.</p>
                        </div>
                        <div class="form-group">
                            <label for="title_en">Anglický nadpis:</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis"/>
                        </div>
                        {{--<span style="color:red">zmenit na  date ?</span>--}}
                        <div class="form-group">
                            <label for="duration">Trvanie:</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Trvanie" />
                        </div>
                        {{--<span style="color:red">prepojiť so staff ?</span>--}}
                        <div class="form-group">
                            <label for="coordinator">Koordinátor:</label>
                            <input type="text" class="form-control" id="coordinator" name="coordinator" placeholder="Koordinátor" />
                            {{--<label for="coordinator">Koordinátor:</label>--}}
                            {{--<input list="staff" name="coordinator" id="coordinator" type="text" class="form-control" placeholder="Koordinátor">--}}
                            {{--<datalist size="10" id="staff">--}}
                                {{--@foreach($staff as $s)--}}
                                    {{--@if( strcmp($s->title1, '' > 1) &&  strcmp($s->title2, '' > 1)) {--}}
                                    {{--<option value="{{ $s->title1 }} {{ $s->surname }} {{ $s->name }}, {{ $s->title2 }}"></option>--}}
                                    {{--} @elseif(strcmp($s->title1, '' > 1)) {--}}
                                    {{--<option value="{{ $s->title1 }} {{ $s->surname }} {{ $s->name }}"></option>--}}
                                    {{--} @else{--}}
                                    {{--<option value="{{ $s->surname }} {{ $s->name }}"></option>--}}
                                    {{--}--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</datalist>--}}
                        </div>

                        <div class="form-group">
                            <label for="partners">Partneri:</label>
                            <input type="text" class="form-control" id="partners" name="partners" placeholder="Partneri" />
                        </div>
                        <div class="form-group">
                            <label for="iCode">Interný kód:</label>
                            <input type="text" class="form-control" id="iCode" name="iCode" placeholder="Kód"  />
                        </div>
                    </div>

                    <div class="col-md-5 col-md-offset-1">
                        <div class="form-group">
                            <label for="web">Web:</label>
                            <input type="text" class="form-control" id="web" name="web" placeholder="Web" />
                        </div>
                        <div class="form-group">
                            <label for="annotationSK">Slovenská anotácia:</label>
                            <textarea rows="10" class="form-control" id="annotationSK"  name="annotationSK"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="annotationEN">Anglická anotácia:</label>
                            <textarea rows="10" class="form-control" id="annotationEN" name="annotationEN"></textarea>
                        </div>
                    </div>

                </div>
                <div class="row text-center">
                    <input type="submit" class="btn btn-success" value="Pridať projekt"/>
                </div>
            </form>
		</div>
	</div>
@stop