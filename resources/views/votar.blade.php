@extends('layouts.app')

@section('css')
<link href="{{ asset('css/cards.css') }}" rel="stylesheet">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
@endsection

@section('content')


<div class="row row-cols-1 row-cols-md-3 g-4">
  
@foreach($candidatos as $candidato)
    <div class="col">
        <div class="profile-card">
                <img src="https://happytravel.viajes/wp-content/uploads/2020/04/146-1468479_my-profile-icon-blank-profile-picture-circle-hd.png" alt="image1" class="profile-icon" />
                <div class="profile-name">{{$candidato->nombre}} {{$candidato->apellido}}</div>
                <div class="profile-position"># {{$candidato->numero_tarjeton}}</div>
                <a href="#" class="button" style="text-decoration: none;">Votar</a>
        </div>
    </div>
@endforeach

</div>

<div class="d-grid gap-2 col-6 mx-auto mt-5">
  <a href="/inicio" class="btn btn-outline-dark mt-3" type="button">Volver a inicio</a>
  
</div>

@endsection


