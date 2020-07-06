@extends('writer.layout')

@section('content')

@if($article->observations != NULL)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>El artículo fué rechazado por la siguiente razón:</strong> {{$article->observations}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="container">


    <div class="d-flex justify-content-center">


        <a href="{{route('writer.articles.create')}}" class="btn btn-lg btn-primary"><span
                class="fa fa-plus mr-2"></span>Nuevo</a>

        @if($article->status != 'PUBLISHED')
        <a href="{{route('writer.articles.edit', $article->id)}}" class="btn btn-lg btn-warning ml-3 mr-3
            "><span class="fa fa-pencil mr-2"></span>Editar</a>



        {!! Form::open(['route' => ['writer.articles.destroy', $article->id], 'method' =>
        'DELETE']
        )!!}
        <button type="submit" id="deleteButton" data-name="{{ $article->title }}" class="btn btn-lg btn-danger"><span
                class="fa fa-trash mr-2"></span>Eliminar</button>
        {!! Form::close() !!}
        @endif

    </div>

    <div class="col-lg-12">

        <div class="card my-4">

            <div class="card-header">
                <h1>{{$article->title}}</h1>

            </div>
            <div class="card-body">
                <!-- Preview Image -->
                <img class="img-fluid rounded" src="{{$article->image}}" alt="">

                <hr>
                <strong>Extracto:</strong>
                <br>
                {{$article->excerpt}}
                <hr>

                <p>
                    <strong>Categoría: </strong><a
                        href="{{route('selectByCategory', $article->category->slug)}}">{{$article->category->name}}</a>
                    <br>
                    <strong>Autor:</strong> <a
                        href="{{route('admin.users.show',$article->user->id)}}">{{$article->user->username}}</a>
                    <br>
                    Publicado el {{$article->created_at->formatLocalized('%A de %d de %B de %Y')}} a
                    las {{$article->created_at->format('H:i')}}
                    <br>

                </p>
                <hr>
                <!-- Post Content -->
                {!! $article->body!!}

            </div>
        </div>
    </div>


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