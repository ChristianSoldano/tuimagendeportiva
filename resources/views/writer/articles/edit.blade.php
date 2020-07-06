@extends('writer.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="d-inline">Editar artículo</h3>
    </div>
    <div class="card-body">
        {!! Form::model($article, ['route' => ['writer.articles.update', $article->id], 'method' => 'PUT', 'files' => true])!!}
        @include('writer.articles.partials.form')
        {!! Form::close()!!}
    </div>
</div>
@endsection