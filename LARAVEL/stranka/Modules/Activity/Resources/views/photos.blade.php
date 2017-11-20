@extends('base_structure')

@section('additional_headers')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div id="emPAGEcontent" class="container">
ako $categories su zlozky fotiek<br>
ako $photos konkretne fotky<br>
treba spravit nejaky nahlad ako je na papiery s dotazmi spomenuty .. vybrat 2-3 fotky na preklik do celej galerie<br>
videa sa dokoncia potom<br>
pridat preklik na youtube a flickr ( href nechat prazdny ) - to sa spravi cez config<br>
media tiez nadizajnovat data vam tam chodia
</div>    
@stop