@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<section class="banner banner--center" style="background-image: url('{{ URL::asset('images/banners/banner14.jpg') }}')">
    <h1>Fotogaléria</h1>
</section>
<div id="emPAGEcontent" class="container">
ako $categories su zlozky fotiek (event001 event002...)<br>
ako $previews 4 prve fotky na vytvorenie divka na preklik do celej galerie<br>
treba spravit nejaky nahlad ako je na papiery s dotazmi spomenuty<br>
pridat preklik na youtube a flickr ( href nechat prazdny ) - to sa spravi cez config<br>
media tiez nadizajnovat data vam tam chodia
</div>    
@stop