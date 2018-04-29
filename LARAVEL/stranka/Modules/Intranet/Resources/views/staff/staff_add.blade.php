@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-select.js') }}"></script>
<link href="{{ URL::asset('css/bootstrap-select.css') }}" rel="stylesheet">
@stop

@section('content_admin')
<script>
    $('.selectpicker').selectpicker();
</script>
<div class="container">
	<div class="staff-intra"> 
        <div class="row">    
            <div class="col-md-10 col-md-offset-1">        
                <div class="pull-left">
                    <a href="{{ url('/staff-admin') }}" class="btn btn-primary btn-back"> Späť </a>
                </div>
                <h2>Pridanie nového zamestnanca</h2>
            </div>
        </div>       
        <form action="{{ url('/staff-admin-add-action') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="name">* Meno:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Meno" />
                    </div>
                    <div class="form-group">
                        <label for="surname">* Priezvisko:</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Priezvisko" />
                    </div>
                    <div class="form-group">
                        <label for="title1">Titul(y) pred menom:</label>
                        <input type="text" class="form-control" id="title1" name="title1" placeholder="Titul(y) pred menom" />
                    </div>
                    <div class="form-group">
                        <label for="title2">Titul(y) za menom:</label>
                        <input type="text" class="form-control" id="title2" name="title2" placeholder="Titul(y) za menom" />
                    </div>
                    <div class="form-group">
                        <label for="ldap"> LDAP meno (xsagan):</label>
                        <input type="text" class="form-control" id="ldap" name="ldap" placeholder="LDAP meno (xsagan)" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label for="web">Web adresa:</label>
                        <input type="text" class="form-control" id="web" name="web" placeholder="Web adresa" />
                    </div>
                    <div class="form-group">
                        <label for="role">* Rola:</label>
                        <select class="form-control" id="role" name="role">
                            @foreach($roles as $key => $r)
                                <option value="{{ $key }}">{{ $r }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="web">ID v informačnom systéme:</label>
                        <input type="number" class="form-control" id="is_id" name="is_id" placeholder="IS ID" />
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <div class="form-group">
                        <label for="department">* Oddelenie:</label>
                        <select class="form-control" id="department" name="department">
                            @foreach($departments as $key => $d)
                                <option value="{{ $key}}">{{ $d}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="func">Funkcia:</label>
                        <div >
                            @foreach($functions as $f)
                                <div>
                                    <label><input type="checkbox" name="func[]" value="{{ $f->f_id }}" />
                                    {{ $f->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room">Miestnosť:</label>
                        <input type="text" class="form-control" id="room" name="room" placeholder="Miestnost" />
                    </div>
                    <div class="form-group">
                        <label for="phone">Klapka:</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Klapka" />
                    </div>

                    <div class="form-group">
                        <label for="img">Profilový obrázok:</label>
                        <input type="file" class="form-control" id="img" name="img" placeholder="profile img" />
                    </div>
                    @if(has_permission('admin'))
                    <div class="form-group">
                        <label for="perms">Oprávnenia:</label>
                        <div id="perms">
                            @foreach($permission_roles as $key => $pr)
                                <div class="perms"><input type="checkbox" name="perm[]" value="{{ $key }}" />
                                        {{ $pr }}
                                    </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subjects_staff">Predmety k vyučujúcemu:</label>
                        <select class="form-control selectpicker" data-size="5" data-width="auto" data-live-search="true" multiple id="subjects_staff" name="subjects_staff[]" tabindex="2">  
                            @foreach($subjects as $s)
                                <option value="{{ $s->sub_id }}" data-tokens="{{ $s->abbrev }} {{ $s->title }}" >{{ $s->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row lastButton">
                <input type="submit" class="btn btn-success text-center staff-intra__add" value="Pridať zamestnanca" />
            </div>
        </form>
	</div>
</div>  
@stop