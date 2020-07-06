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
                <a href="{{$sn->url}}"><i class="fa fa-facebook fa-2x"></i></a>
                @endif
                @if($sn->name == 'INSTAGRAM')
                <a href="{{$sn->url}}"><i class="fa fa-instagram fa-2x"></i></a>
                @endif
                @if($sn->name == 'TWITTER')
                <a href="{{$sn->url}}"><i class="fa fa-twitter fa-2x"></i></a>
                @endif
                @endforeach
            </div>
        </div>
        <hr>
        <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary btn-sm">
            Editar Perfil</span>
        </a>
        @endif
    </div>
</div>

@endsection