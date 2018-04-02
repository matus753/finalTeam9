@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>

<script src="{{ URL::asset('js/bootstrap-select.js') }}"></script>
<link href="{{ URL::asset('css/bootstrap-select.css') }}" rel="stylesheet">
@stop

@section('content_admin')
<script>
    $('.selectpicker').selectpicker();
</script>
<div class="container">
    <div class="intra-div">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="pull-left">
                    <a href="{{ url('/projects-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                </div>
                <h2 style="text-align:center; margin-left: 10%;">{{ $item->titleSK }}</h2>
            </div>
        </div>

        <form name="projectForm" action="{{ url('/projects-admin-edit-action/'.$item->pr_id) }}" method="post" >
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="role">* Typ:</label>
                        <select class="form-control" name="type">
                            @foreach($types as $t)
                                <option value="{{ $t }}" @if($item->projectType == $t) {{ 'selected' }} @endif >{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_number">* ID číslo:</label>
                        <input type="text" class="form-control" id="id_number" name="id_number" placeholder="ID číslo" value="{{ $item->number }}" required />
                        <p class="required" id="req1">Tato položka musí byť vyplnená.</p>
                    </div>
                    <div class="form-group">
                        <label for="title_sk">* Slovenský nadpis:</label>
                        <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" value="{{ $item->titleSK }}" required />
                        <p class="required" id="req2">Tato položka musí byť vyplnená.</p>
                    </div>
                    <div class="form-group">
                        <label for="title_en">Anglický nadpis:</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" value="{{ $item->titleEN }}" />
                    </div>

                    <div class="form-group">
                        <label for="duration">Trvanie:</label>
                        <input type="text" class="form-control" id="duration" name="duration" placeholder="Trvanie" value="{{ $item->duration }}"  />
                    </div>
 
                    <div class="form-group">
                        <label for="coordinator">Koordinátor:</label>
                        <select class="form-control selectpicker" data-size="5" data-live-search="true" id="coordinator" name="coordinator" tabindex="2">
                            @foreach($staff as $s)
                                <option value="{{ $s->s_id }}" @if($s->s_id == $item->coordinator) {{ 'selected' }} @endif>{{ $s->title1 }}&nbsp;{{ $s->name }}&nbsp;{{ $s->surname }}&nbsp;{{ $s->title2 }}</option>
                            @endforeach
                        </select>
                        <p style="font-size: 12px; margin-bottom: 0; margin-top: 10px; color: red;">Ak je vložený vlastný záznam koordinátora, tento záznam bude uprednostnený.</p>
                        <input name="custom_coordinator" type='text' placeholder='Vlastný záznam...' class='form-control' value="@if(!is_numeric($item->coordinator)) {{ $item->coordinator }}  @endif" />
                    </div>

                    <div class="form-group">
                        <label for="partners">Partneri:</label>
                        <input type="text" class="form-control" id="partners" name="partners" placeholder="Partneri" value="{{ $item->partners }}" />
                    </div>
                    <div class="form-group">
                        <label for="iCode">Interný kód:</label>
                        <input type="text" class="form-control" id="iCode" name="iCode" placeholder="Kód" value="{{ $item->internalCode }}"  />
                    </div>
                </div>

                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="web">Web:</label>
                        <input type="text" class="form-control" id="web" name="web" placeholder="Web"  value="{{ $item->web }}" />
                    </div>
                    <div class="form-group">
                        <label for="annotationSK">Slovenská anotácia:</label>
                        <textarea rows="12" class="form-control" id="annotationSK"  name="annotationSK">{{ $item->annotationSK }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="annotationEN">Anglická anotácia:</label>
                        <textarea rows="12" class="form-control" id="annotationEN" name="annotationEN">{{ $item->annotationEN }}</textarea>
                    </div>
                </div>

            </div>
            <div class="row text-center lastButton">
                <input type="submit" class="btn btn-success" value="Ulož zmeny" />
            </div>
        </form>
    </div>
</div>
@stop