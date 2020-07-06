@extends('admin.layout')

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="d-inline">Editar artículo</h3>
    </div>
    <div class="card-body">
        <div class="container">
            {!! Form::model($article, ['route' => ['admin.articles.update', $article->id], 'method' => 'PUT', 'files' =>
            true])!!}
            @include('admin.articles.partials.form')
            {!! Form::close()!!}
        </div>
    </div>
</div>
@endsection