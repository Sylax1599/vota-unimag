@extends ('layouts.admin')

@section('css')
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection


@section('content')

@section('navigation')
  <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item" aria-current="page">Home</li>
    <li class="breadcrumb-item" aria-current="page"><a href="/home/organos">CRUD Organo</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar organo</li>
  </ol>
@endsection

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar organo') }}</div>
                  <div class="card-body">
                      <form action="/home/organos/{{$organo->id}}" method="POST">
                        @csrf
                        @method('PUT')
                              <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" 
                                class="form-control" 
                                id="nombre" name="nombre" value="{{$organo->nombre}}">
                              </div>

                              <div class="mb-3">
                              <label for="nombre" class="form-label">Color</label>
                              <input type="color" class="form-control" id="favcolor" name="favcolor" value="#dce9ff" list="reds" />
                              <datalist id="reds">
                              <option>#ffc2c2</option>
                              <option>#ffd3c2</option>
                              <option>#fff9c2</option>
                              <option>#c9ffc2</option>
                              <option>#c2ffe1</option>
                              <option>#c2fffa</option>
                              <option>#c2f3ff</option>
                              <option>#c2d0ff</option>
                              <option>#cbc2ff</option>
                              <option>#dcc2ff</option>
                              <option>#eec2ff</option>
                              <option>#ffc2f5</option>
                              <option>#ffc2db</option>
                              <option>#ffc2ca</option>
                            </datalist>
                              <br>
                            </div>
                             

                                <a href="/home/organos" class="btn btn-secondary">Cancelar</a> 

                              <button type="submit" class="btn btn-primary">Actualizar</button>
                      </form>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection