@extends('writer.layout')

@section('content')

<h1>Categorías</h1>

<div class="card">
    <div class="card-header">
        <h3 class="d-inline">Listado</h3>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th width="10px">ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection