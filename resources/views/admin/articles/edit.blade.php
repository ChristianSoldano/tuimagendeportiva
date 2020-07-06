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

            <div class="form-group">
                {{Form::label('status', 'Estado')}} <br>
                <input type="checkbox" name="status" data-toggle="toggle" data-on="<i class='fa fa-check mr-1'></i>Publicado"
                    data-off="<i class='fa fa-clock-o'></i> En Revisión" data-onstyle="success" data-offstyle="warning"
                    @if($article->status == 'PUBLISHED') checked @endif data-width="140" data-height="40">
            </div>


            @include('admin.articles.partials.form')
            {!! Form::close()!!}
        </div>
    </div>
</div>
@endsection