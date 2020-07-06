@extends('admin.layout')
@section('content')

<h1>Solicitudes</h1>

<div class="card">
    <div class="card-header">
        <h3 class="d-inline">Solicitudes de publicaciones</h3>
    </div>
    <div class="table-responsive-lg">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="10px">ID</th>
                    <th>Escritor</th>
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
                    <td><a href="{{route('admin.users.show',$article->user->id)}}">{{$article->user->username}}</a></td>
                    <td><a href="{{route('admin.requests.show', $article->id)}}">{{$article->title}}</a></td>
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
                            <a href="{{route('admin.requests.show', $article->id)}}" class="btn btn-primary">
                                <span class="fa fa-eye"></span>
                            </a>
                            @if($article->status != 'PUBLISHED')
                            <a href="{{route('admin.requests.edit', $article->id)}}" class="btn btn-warning">
                                <span class="fa fa-pencil"></span>
                            </a>
                            {!! Form::open(['route' => ['admin.articles.destroy', $article->id], 'method' =>
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