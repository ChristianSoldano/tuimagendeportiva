@extends('admin.layout')

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

        <a href="{{route('admin.requests.edit', $article->id)}}" class="btn btn-lg btn-warning ml-3 mr-3
            "><span class="fa fa-pencil mr-2"></span>Editar</a>

        {!! Form::open(['route' => ['admin.articles.destroy', $article->id], 'method' =>
        'DELETE']
        )!!}
        <button type="submit" id="deleteButton" data-name="{{ $article->title }}" class="btn btn-lg btn-danger"><span
                class="fa fa-trash mr-2"></span>Eliminar</button>
        {!! Form::close() !!}

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

                <p>
                    Categoría: <a
                        href="{{route('selectByCategory', $article->category->slug)}}">{{$article->category->name}}</a>
                    <br>
                    Publicado el {{$article->created_at->formatLocalized('%A de %d de %B de %Y')}} a
                    las {{$article->created_at->format('H:i')}}
                    <br>
                    Autor: <a href="{{route('admin.users.show',$article->user->id)}}">{{$article->user->username}}</a>
                </p>

                <hr>

                <!-- Post Content -->
                {!! $article->body!!}

                <hr>

            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">

        {!! Form::open(['route' => ['admin.requests.reject', $article->id], 'method' =>'POST'])!!}
        {{ Form::hidden('reason', 'No se aclaró una razon.', ['id' => 'reason']) }}
        <button type="submit" id="rejectButton" data-name="{{ $article->title }}"
            class="btn btn-lg btn-danger ml-3 mr-3"><span class="fa fa-times mr-2"></span>Rechazar</button>
        {!! Form::close() !!}

        <a href="{{route('admin.requests.accept', $article->id)}}" class="btn btn-lg btn-success ml-3 mr-3
                    "><span class="fa fa-check mr-2"></span>Aceptar</a>

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

$('button#rejectButton').on('click', function(e){
    var name = $(this).data('name');
    e.preventDefault();
    (async () => {
const {value: reason} = await Swal.fire({
  title: 'Ingrese la razón por la cual el artículo fué rechazado.',
  input: 'text',
  inputPlaceholder: 'Razón',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: "Cancelar",
  confirmButtonText: 'Continuar'
})

if (reason) {
    document.getElementById("reason").value = reason;
    Swal.fire({
        title: '¿Está seguro?',
        html: "<strong>Razón:</strong> "+reason+".",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Enviar'
        
})
    .then ((result) => {        
        
        if (result.value) {
            
         $(this).closest("form").submit();
        }
});
}
})()

}); 




    </script>

    @endsection