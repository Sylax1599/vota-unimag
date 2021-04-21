@extends ('layouts.app')

@section('css')
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar candidato') }}</div>
                  <div class="card-body">
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
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="votacion" value="">
                                  <option selected>Seleccionar la elección</option>
                                  @foreach ($votaciones as $votacion)
                                    <option value="{{$votacion->id}}">{{$votacion->nombre}}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="mb-3">
                                  <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="organo" value="">
                                    <option selected>Seleccionar un organo</option>
                                    @foreach ($organos as $organo)
                                      <option value="{{$organo->id}}">{{$organo->nombre}}</option>
                                    @endforeach
                                  </select>
                              </div>

                                <a href="/home/candidatos" class="btn btn-secondary">Cancelar</a> 

                              <button type="submit" class="btn btn-primary">Actualizar</button>
                      </form>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection