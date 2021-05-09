@extends('layouts.app')

@section('css')
<link href="{{ asset('css/cards.css') }}" rel="stylesheet">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
@endsection

@section('content')

<div class="col-auto text-center mt-1 mb-5">
  <h1>
  <?php 
  foreach($organo as $key){
    echo $key->nombre;
  }
  ?>
  </h1>
</div>


<div class="row row-cols-1 row-cols-md-3 g-4">
  
@foreach($candidatos as $candidato)
    <div class="col">
        <div class="profile-card">
                <img src="https://happytravel.viajes/wp-content/uploads/2020/04/146-1468479_my-profile-icon-blank-profile-picture-circle-hd.png" alt="image1" class="profile-icon" />
                <div class="profile-name">{{$candidato->nombre}} {{$candidato->apellido}}</div>
                <div class="profile-position"># {{$candidato->numero_tarjeton}}</div>
                <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="{{$candidato->id}}" data-bs-whatever="{{$candidato->nombre}}">Votar</button>
        </div>
    </div>
@endforeach

</div>

<div class="d-grid gap-2 col-6 mx-auto mt-5">
  <a href="/inicio" class="btn btn-outline-dark mt-3" type="button">Volver a inicio</a>
  
</div>


<div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar voto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('registroVoto')}}" method="POST">
      @csrf
      <div class="modal-body">
      <input type="hidden" name="password" value="{{Auth::user()->password}}">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">ID:</label>
            <input type="text" name="voto" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Confirmar contraseña:</label>
            <input type="password" name="confirm_password" class="form-control" id="message-text"></input>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirmar voto</button>
      </div>
    </div>
    </form>
  </div>
</div>


@endsection




