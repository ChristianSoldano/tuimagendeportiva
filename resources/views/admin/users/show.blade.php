@extends('admin.layout')
@section('content')

<div class="container mt-5">
    <div class="text-center">
        <h2>{{$user->username}}</h2>
        <img src="{{$user->avatar}}" width="300" height="300">
        <br>

        {{$user->name . " " . $user->lastname}}
        @if($user->permissions == 'ADMIN')
        <h2>ADMINISTRADOR</h2>
        @endif
        @if($user->permissions == 'WRITER')
        <h2>ESCRITOR</h2>
        @endif
        @if($user->permissions == 'USER')
        <h2>USUARIO</h2>
        @endif
        <hr>
        @if($user->permissions != 'USER')
        <div class="panel panel-default">
            <div class="panel-heading text-center">Redes</div>
            <div class="panel-body text-center">
                @foreach($socialNetworks as $sn)
                @if($sn->name == 'FACEBOOK')
                <a href="{{$sn->url}}" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
                @endif
                @if($sn->name == 'INSTAGRAM')
                <a href="{{$sn->url}}" target="_blank"><i class="fa fa-instagram fa-2x"></i></a>
                @endif
                @if($sn->name == 'TWITTER')
                <a href="{{$sn->url}}" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
                @endif
                @endforeach
            </div>
        </div>
        @endif
        <hr>
        @if($user->id != auth()->user()->id)
        <input type="button" class="btn btn-primary" value="Editar Permisos" onclick="showDiv()" />

        <div id="editPermissions" style="display:none;" class="">
            {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT'])!!}

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    {!! Form::select('permissions', array('ADMIN' => 'Administrador', 'WRITER' =>
                    'Escritor','USER' =>
                    'Usuario'), $user->permissions,['class' => 'form-control mt-3'])!!}
                </div>
                <div class="col-3"></div>
            </div>
            {{Form::submit('Guardar', ['class' => 'btn btn-success mt-3'])}}
            {!! Form::close()!!}
        </div>
        @endif
    </div>
</div>

@section('scripts')
<script>
    function showDiv() {
   document.getElementById('editPermissions').style.display = "block";
}
</script>
@endsection
@endsection