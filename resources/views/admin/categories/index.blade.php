@extends('admin.layout')

@section('content')


@if(session('info'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Excelente!</strong> {!!session('info')!!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<h1>Categorías</h1>

<div class="card">
    <div class="card-header">
        <h3 class="d-inline">Listado</h3>
        <a href="{{route('admin.categories.create')}}" class="btn btn-primary pull-right"><span
                class="fa fa-plus mr-2"></span>Crear Nueva Categoría</a>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th width="10px">ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>
                    <div class="btn-group-vertical" role="group" aria-label="Basic example">

                        <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-warning">
                            <span class="fa fa-pencil"></span>
                        </a>


                        {!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' =>
                        'DELETE']
                        )!!}
                        <button type="submit" id="deleteButton" data-name="{{ $category->name }}"
                            class="btn btn-danger"><span class="fa fa-trash"></span></button>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    $('button#deleteButton').on('click', function(e){
    var name = $(this).data('name');
    e.preventDefault();
Swal.fire({
  title: '¿Estás seguro?',
  html: "Se eliminarán todos los artículos que se encuentren en la categoría <strong>" +name+ "</strong>",
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