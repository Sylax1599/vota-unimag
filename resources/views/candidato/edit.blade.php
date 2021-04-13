@extends ('layouts.app')


@section('content')

<div class="container">

  <div class="row justify-content-center">

    <div class="col-md-8">
        <div class="card">
            <form action="/home/candidatos/{{$candidato->id}}" method="POST">
              @csrf
              @method('PUT')
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" 
              class="form-control" 
              id="nombre" name="nombre" value="{{$candidato->nombre}}">
            </div>
            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" 
              class="form-control" id="apellido" 
              name="apellido" value="{{$candidato->apellido}}">
            </div>
            <div class="mb-3">
              <label for="cedula" class="form-label">Cedula</label>
              <input type="text" 
              class="form-control" 
              id="cedula" 
              name="cedula" value="{{$candidato->numero_identificacion}}">
            </div>

            <div class="mb-3">
              <label for="tarjeton" class="form-label"># Tarjeton</label>
              <input type="text" 
              class="form-control" id="tarjeton" 
              name="tarjeton" value="{{$candidato->numero_tarjeton}}">
            </div>

            <div class="mb-3">
              <label for="votacion" class="form-label">Eleccion</label>
              <input type="text" class="form-control" 
              id="votacion" name="votacion" value="{{$candidato->votacion_id}}">
            </div>

            <div class="mb-3">
              <label for="organo" class="form-label">Organo</label>
              <input type="text" class="form-control"
                id="organo" name="organo" value="{{$candidato->organo_id}}">
            </div>

              <a href="/home/candidatos" class="btn btn-secondary">Cancelar</a> 

            <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
      </div>
    </div>
  </div>
</div>

@endsection