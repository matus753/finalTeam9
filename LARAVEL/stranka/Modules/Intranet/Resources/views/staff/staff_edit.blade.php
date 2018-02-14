@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

<script src="{{ URL::asset('js/datatables.min.js') }}"></script>
@stop

@section('content_admin')

<div id="emPAGEcontent" class="container">
    <br>
	<div class="row">
		<div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <a href="{{ url('/staff-admin') }}" class="btn btn-primary"> Späť </a>
                    </div>
                    <div class="text-center">
                        <h3>Pridanie nového projektu</h3>
                    </div>
                </div>
            </div>
            <h2>premenovat db IDcka</h2>
            <br>
            <form action="{{ url('/staff-admin-edit-action/'.$item->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Meno:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Meno" value="{{ $item->name }}"/>
                </div>
                <div class="form-group">
                    <label for="surname">Priezvisko:</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Priezvisko" value="{{ $item->surname }}" />
                </div>
                <div class="form-group">
                    <label for="title1">Titul(y) pred menom:</label>
                    <input type="text" class="form-control" id="title1" name="title1" placeholder="Titul(y) pred menom" value="{{ $item->title1 }}"/>
                </div>
                <div class="form-group">
                    <label for="title2">Titul(y) za menom:</label>
                    <input type="text" class="form-control" id="title2" name="title2" placeholder="Titul(y) za menom" value="{{ $item->title2 }}"/>
                </div>
                <div class="form-group">
                    <label for="ldap">LDAP meno (xsagan):</label>
                    <input type="text" class="form-control" id="ldap" name="ldap" placeholder="LDAP meno (xsagan)" value="{{ $item->ldapLogin }}" />
                </div>
                <div class="form-group">
                    <label for="room">Miestnost:</label>
                    <input type="text" class="form-control" id="room" name="room" placeholder="Miestnost" value="{{ $item->room }}" />
                </div>
                <div class="form-group">
                    <label for="phone">Klapka:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Klapka" value="{{ $item->phone }}" />
                </div>
                <div class="form-group">
                    <label for="department">Oddelenie:</label>
                    <select class="form-control" id="department" name="department">
                        @foreach($departments as $key => $d)
                            <option value="{{ $key }}" @if($item->department == $key) {{ 'selected' }} @endif>{{ $d}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="role">Rola:</label>
                    <select class="form-control" id="role" name="role">
                        @foreach($roles as $key => $r)
                            <option value="{{ $key }}" @if($item->staffRole == $key) {{ 'selected' }} @endif>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="func">Funkcia:</label>
                    <input type="text" class="form-control" id="func" name="func" placeholder="Funkcia" value="{{ $item->function }}" />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $item->email }}" />
                </div>
                <div class="form-group">
                    <label for="web">Web adresa:</label>
                    <input type="text" class="form-control" id="web" name="web" placeholder="Web adresa" value="{{ $item->web }}" />
                </div>
                <div class="form-group">
                    <label for="default_photo">Default photo(ak je zaškrtnuté nastaví sa default fotka aj ked sa uploadne nova):</label>
                    <input type="checkbox" id="default_photo" name="default_photo">
                </div>
                <div class="form-group">
                    <label for="img">Nový obrazok:</label>
                    <input type="file" class="form-control" id="img" name="img" placeholder="profile img" />
                </div>
                <div class="form-group">
                    <label for="perms">Permissions:</label>
                    <div id="perms">
                        @foreach($permission_roles as $key => $pr) 
                            {{ $pr }}
                            <input type="checkbox" name="perm[]" value="{{ $key }}" @foreach($item->roles as $r) @if($r == $key) {{ 'checked' }} @endif  @endforeach/>
                        @endforeach
                    </div>
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Pridaj" />
            </form>
            <p>Aktuálna profilofka</p>
            <img src="{{ get_profile_photo($item->photo) }}" class="img-responsive" style="max-width: 300px; max-height: 300px;">

		</div>
	</div>
</div>   
@stop