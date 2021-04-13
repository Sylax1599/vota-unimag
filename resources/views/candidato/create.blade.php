@extends ('layouts.app')


@section('content')

<form action="/home/candidatos" method="POST">

    @csrf
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" tabindex="1">
  </div>
  <div class="mb-3">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" class="form-control" id="apellido" name="apellido">
  </div>
  <div class="mb-3">
    <label for="cedula" class="form-label">Cedula</label>
    <input type="text" class="form-control" id="cedula" name="cedula">
  </div>

  <div class="mb-3">
    <label for="tarjeton" class="form-label"># Tarjeton</label>
    <input type="text" class="form-control" id="tarjeton" name="tarjeton">
  </div>

  <div class="mb-3">
    <label for="votacion" class="form-label">Eleccion</label>
    <input type="text" class="form-control" id="votacion" name="votacion">
  </div>

  <div class="mb-3">
    <label for="organo" class="form-label">Organo</label>
    <input type="text" class="form-control" id="organo" name="organo">
  </div>

   <a href="/home/candidatos" class="btn btn-secondary">Cancelar</a> 

  <button type="submit" class="btn btn-primary">Agregar</button>
</form>


@endsection