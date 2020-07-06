@extends('admin.layout')
@section('content')

@if(session('info'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Excelente!</strong> {!!session('info')!!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<h1>Usuarios</h1>

<div class="row">
    <div class="col-12">
        {!! Form::open(['route' => 'admin.users.index', 'method' => 'GET', 'class' => 'form-inline my-2 my-lg-0'])!!}
        {!! Form::text('searchTerm',null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Buscar usuario'])!!}
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        @if($search !=null)
        <a class="btn btn-danger my-2 my-sm-0 ml-2" href="{{route('admin.users.index')}}" role="button"><i
                class="fa fa-times" aria-hidden="true"></i> {{$search}} </a>
        @endif
        </form>

    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
    <h3 class="d-inline">{{$users->total()}}@if($users->total() == 1) Usuario encontrado @else Usuarios Encontrados @endif</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="10px">ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Permisos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('admin.users.show',$user->id)}}">{{$user->username}}</a></td>
                    <td>{{$user->name . " " . $user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->permissions == "ADMIN")
                        <span class="badge badge-pill badge-success">ADMINISTRADOR</span>
                        @elseif($user->permissions == "WRITER")
                        <span class="badge badge-pill badge-primary">ESCRITOR</span>
                        @else
                        <span class="badge badge-pill badge-secondary">SIN PERMISOS</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group-vertical" role="group" aria-label="Basic example">
                            <a href="{{route('admin.users.show',$user->id)}}" class="btn btn-primary">
                                <span class="fa fa-eye"></span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-5">{{$users->render()}}</div>

@endsection