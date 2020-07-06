@extends('admin.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="d-inline">Crear categoría</h3>
    </div>
    <div class="card-body">
        {!! Form::open(['route' => 'admin.categories.store'])!!}
        @include('admin.categories.partials.form')
        {!! Form::close()!!}
    </div>
</div>
@endsection