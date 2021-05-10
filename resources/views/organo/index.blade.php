@extends ('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

<div class="container">

@section('navigation')
  <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">CRUD Organo</li>
  </ol>
@endsection




    <a href="/home/organos/create" class="btn btn-primary mt-2 mb-3"> Añadir nuevo organo</a>

  

    
    <table id="example" class="table table-striped table-hover table-sm" style="width:100%">

            <thead class="table-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col" style="width: 40%">Accion</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach ($organos as $key=>$organo)
                <tr>
                <th scope="row">{{$organo->id}}</th>
                <td>{{$organo->nombre}}</td>
                
               
                <td>
                    <form action="{{ route('organos.destroy', $organo->id) }}" method="POST">
                
                    <a href="organos/{{$organo->id}}/edit" class="btn btn-primary">
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