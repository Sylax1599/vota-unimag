@extends ('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

<div class="container">

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Importar votantes</li>
  </ol>
</nav>

    <div class="flex-center position-ref full-height">
        
        <div class="container mt-5">
            <h3>Importar votantes</h3>
    
            @if ( $errors->any() )
    
                 <div class="alert alert-danger" role="alert">
                    @foreach( $errors->all() as $error )<li>{{ $error }}</li>@endforeach
                </div>
            @endif
    
            @if(isset($numRows))
            
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Se importaron <strong>{{$numRows}} registros.</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                
            @endif
    
            <form action="{{route('users.import')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-5">
                        <div class="custom-file">
                        
                        <input class="form-control" type="file" id="formFile" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Importar</button>
                        </div>
                    </div>
                </div>
            </form>


            <div class="row mt-3">
            <div class="col-5">
            <a href="/home" class="btn btn-danger">Volver al panel de administración</a>
            </div>
           
            </div>
           
        </div>
    </div>
</div>
@endsection