@extends('admin.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="d-inline">Editar categoría</h3>
    </div>
    <div class="card-body">
        {!! Form::model($category, ['route' => ['admin.categories.update', $category->id], 'method' => 'PUT'])!!}
        @include('admin.categories.partials.form')
        {!! Form::close()!!}
    </div>
</div>
@endsection