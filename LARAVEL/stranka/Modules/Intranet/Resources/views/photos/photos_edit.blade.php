@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
<link href="{{ URL::asset('css/activity.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/lightbox.css') }}" rel="stylesheet">
<script type="text/javascript"  src="{{URL::asset('js/galleries/lightbox.js')}}"></script>
        <script type="text/javascript"  src="{{URL::asset('js/galleries/activity.js')}}"></script>
@stop

@section('content_admin')
<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left" style="margin-top: 20px">
                        <a href="{{ url('/photos-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Editácia galérie obrázkov</h3>
                    </div>
                </div>
            </div>
            <br>
            <form action="{{ url('/photos-admin-edit-action/'.$gallery->pg_id) }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title_sk">* Slovenský nadpis:</label>
                            <input type="text" class="form-control" id="title_sk" name="title_sk" placeholder="Slovenský nadpis" value="{{ $gallery->title_SK }}" required />
                            </div>
                            <div class="form-group">
                                <label for="title_en">* Anglický nadpis:</label>
                                <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Anglický nadpis" value="{{ $gallery->title_EN }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Dátum:</label>
                                <input type="date" class="form-control" id="date" value="{{ format_time($gallery->date, true) }}" name="date"/>
                            </div>               
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success pull-right" value="Uložiť" />
                    </div>
                </div>
            </form>
            <br>
            <a href="{{ url('/photos-admin-upload/'.$gallery->pg_id) }}" class="btn btn-primary pull-right">Pridaj fotky</a>
            <br>
            @foreach($photos as $key=>$p)
                @if($key % 4 == 0)
                    <div class="row" style="margin-top: 25px; margin-bottom: 25px">
                @endif
                        <div class="col-md-3">
                            <div class="text-center">
                                <a href="{{ get_gallery_photo($gallery->folder, $p->hash_name) }}" data-lightbox="{{$gallery->folder}}" data-title="{{ $gallery->title_SK }}">
                                    <img src="{{ get_gallery_photo($gallery->folder, $p->hash_name) }}" class="hover-shadow edit-image">
                                    <a href="{{ url('/photos-admin-delete-item-action/'.$p->p_id.'/'.$gallery->pg_id) }}" class="delete-photo"> <span class="glyphicon glyphicon-trash"></span> Vymazať obrázok </a>
                                </a>
                            </div>
                        </div>
                @if($key % 4 == 3)
                    </div>
                @endif
            @endforeach
		</div>
	</div>

</div>   
@stop