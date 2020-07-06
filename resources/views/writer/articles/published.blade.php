@extends('writer.layout')

@section('content')


@if(session('info'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Excelente!</strong> {!!session('info')!!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<h1>Artículos Publicados</h1>

<div class="row">
    <div class="col-12">
        {!! Form::open(['route' => 'writer.articles.published', 'method' => 'GET', 'class' => 'form-inline my-2 my-lg-0'])!!}
        {!! Form::text('title',null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Título del artículo'])!!}
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        @if($search !=null)
        <a class="btn btn-danger my-2 my-sm-0 ml-2" href="{{route('writer.articles.published')}}" role="button"><i
                class="fa fa-times" aria-hidden="true"></i> {{$search}} </a>
        @endif
        </form>

    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h3 class="d-inline">Listado</h3>
        <a href="{{route('writer.articles.create')}}" class="btn btn-primary pull-right"><span
                class="fa fa-plus mr-2"></span>Crear nuevo Artículo</a>
    </div>
    <div class="table-responsive-lg">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="10px">ID</th>
                    <th>Título</th>
                    <th>Creado</th>
                    <th>Estado</th>
                    <th>Accción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)

                <tr>
                    <td>{{$article->id}}</td>
                    <td><a href="{{route('writer.articles.show', $article->id)}}">{{$article->title}}</a></td>
                    <td>{{$article->created_at->diffForHumans()}}</td>
                    <td>
                        @if($article->status == "PUBLISHED")
                        <span class="badge badge-pill badge-success">PUBLICADO</span>
                        @elseif($article->status == "IN_REVIEW")
                        <span class="badge badge-pill badge-warning">EN REVISIÓN</span>
                        @else
                        <span class="badge badge-pill badge-danger">RECHAZADO</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group-vertical" role="group" aria-label="Basic example">
                            <a href="{{route('writer.articles.show', $article->id)}}" class="btn btn-primary">
                                <span class="fa fa-eye"></span>
                            </a>
                            @if($article->status != 'PUBLISHED')
                            <a href="{{route('writer.articles.edit', $article->id)}}" class="btn btn-warning">
                                <span class="fa fa-pencil"></span>
                            </a>
                            {!! Form::open(['route' => ['writer.articles.destroy', $article->id], 'method' =>
                            'DELETE']
                            )!!}
                            <button type="submit" id="deleteButton" data-name="{{ $article->title }}"
                                class="btn btn-danger"><span class="fa fa-trash"></span></button>
                            {!! Form::close() !!}
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>


<div class="d-flex justify-content-center mt-5">{{$articles->render()}}</div>


<script>
    $('button#deleteButton').on('click', function(e){
    var name = $(this).data('name');
    e.preventDefault();
Swal.fire({
  title: '¿Estás seguro?',
  html: "Se eliminará el artículo <strong>" +name+ "</strong>",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: "Cancelar",
  confirmButtonText: 'Si, Eliminar!'
})
.then ((result) => {
    if (result.value) {
       $(this).closest("form").submit();
    }
});
}); 

</script>

@endsection