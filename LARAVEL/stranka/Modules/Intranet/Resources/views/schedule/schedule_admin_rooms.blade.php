@extends('base_structure_admin')

@section('additional_headers_admin')
<link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">

@stop
@section('content_admin')

<div class="container">
    <div class="row">
        <div class="intra-div">
            <div class="pull-left">
                <a href="{{ url('/schedule-admin-subject') }}" class="btn btn-primary"> Späť </a>
            </div>
            <h2>ÚAMT Rozvrhy</h2>
        </div>
        <hr>
        <h3>
            Pridanie miestnosti
        </h3>
        <div class="intra-div">
            <form class="form-horizontal" method="POST" action="{{ url('/schedule-admin-add-room-action') }}">
                {{ csrf_field() }}
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" name="room" id="room" class="form-control" placeholder="Miestnosť" />
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary btn-block" value="Ulož" />
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="intra-div">
            <h3>
                Administrácia miestnosti
            </h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Miestnosť</th>
                        <th>Nový názov miestnosti</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($rooms as $r)
                            <tr>
                                <td>{{ $r->room }}</td>
                                <td><input type="text" class="form-control" placeholder="Nový názov" id="edit_room"  /></td>
                                <td>
                                    <button class="btn btn-success" onclick="edit_room({{ $r->sr_id }})" ><span class="fa fa-check"></span></button>
                                    <a href="javascript:void(0)" onclick="confirmation_redirect('Potvrdenie','Naozaj chcete zmazať tento záznam? {{ $r->room }}', '{{ url('/schedule-admin-delete-room-action/'.$r->sr_id) }}' )" class="btn btn-danger" ><span class="fa fa-trash-o"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function edit_room(e){
        var data = {
            'id' : e,
            'room' : $('#edit_room').val()
        }

        $.ajax({
            url: "{{ url('/schedule-admin-edit-room-action') }}",
            type: "POST",
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        }).done(function(){
            location.reload();
        });
    }
</script>

@stop