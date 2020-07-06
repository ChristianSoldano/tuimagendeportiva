@extends('admin.layout')

@section('content')

{{--
<div class="alert alert-danger mt-4" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    <h4 class="alert-heading">ATENCIÓN <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
    <hr>
    <p style="font-size: 15px;">Hay un error con la validacion del campo <strong>CONTENIDO</strong> que provoca que se borre todo 
    el formulario si es que no se cumple algún requisito de cualquier otro campo. Por favor verifique que se cumplan los requisitos antes de guardar.
    <br><br>
    El área de sistemas está trabajando para solucionarlo.</p>
</div>
--}}

<div class="card">
    <div class="card-header">
        <h3 class="d-inline">Crear artículo</h3>
    </div>
    <div class="card-body">
        {!! Form::open(['route' => 'admin.articles.store', 'files' =>true])!!}
        @include('admin.articles.partials.form')
        {!! Form::close()!!}
    </div>
</div>
@endsection