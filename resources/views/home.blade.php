@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">{{ __('Dashboard') }}</div>
                <h2>Bienvenido, eres un admin</h2>
                <a href="/home/candidatos"> candidatos</a>
                <br>
                <a href="/home/users/import"> Importar usuarios</a>
                </div>
                
               
                
            </div>
        </div>
    </div>
</div>
@endsection
