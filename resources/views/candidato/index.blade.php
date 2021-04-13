@extends ('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

<div class="container">
    <a href="/home/candidatos/create" class="btn btn-primary mt-5"> Crear</a>

    <table id="example" class="table table-striped table-hover table-sm" style="width:100%">

            <thead class="table-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col"># Indentificacion</th>
                <th scope="col"># Tarjeton</th>
                <th scope="col">Votacion</th>
                <th scope="col">Organo</th>
                <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidatos as $candidato)
                <tr>
                <th scope="row">{{$candidato->id}}</th>
                <td>{{$candidato->nombre}}</td>
                <td>{{$candidato->apellido}}</td>
                <td>{{$candidato->numero_identificacion}}</td>
                <td>{{$candidato->numero_tarjeton}}</td>
                <td>{{$candidato->votacion_id}}</td>
                <td>{{$candidato->organo_id}}</td>
                <td>
                    <form action="{{ route('candidatos.destroy', $candidato->id) }}" method="POST">
                
                    <a href="candidatos/{{$candidato->id}}/edit" class="btn btn-primary">
                    <span class="far fa-edit"></span>
                    Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i>
                    Borrar</button>
                    </form>
                </td>
                </tr>
                @endforeach
            </tbody>


        </table>


</div>
    

    
@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function() {
    $('#example').DataTable({
        "lengthMenu": [[5,10,50,-1], [5,10,50,"All"]]      
    });
} );
</script>

@endsection


@endsection