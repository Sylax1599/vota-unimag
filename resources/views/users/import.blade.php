@extends ('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

@section('navigation')
  <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item" aria-current="page">Home</li>
    <li class="breadcrumb-item active" aria-current="page">Importar votantes</li>
    
  </ol>
@endsection

<div class="container">
    <div class="flex-center position-ref full-height">
        
        <div v-cloak v-if="!cargado" class="container mt-3">
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
                            <button type="submit" class="btn btn-primary mt-4">Importar</button>
                        </div>
                    </div>
                </div>
            </form>


           
           
        </div>

        <div v-cloak v-else>
        <div class="alert alert-warning mt-4" role="alert">
            <h4 class="alert-heading d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                <strong class="mr-1">Atencion! </strong>
            </h4>
        <p>Los votantes ya fueron cargados!</p>
        </div>
        </div>
</div>
@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
new Vue({
      el: '#app',
      data(){
        return{
          total_votantes: null,
          cargado: null,
        }
      },
      mounted(){
        
        axios.get('/api/total_usuarios')
        .then((res)=>{
          this.total_votantes=res.data.votantes[0].total_votantes
          if(this.total_votantes>10){
              this.cargado=true
          }
        })
        .catch((e)=>{
          console.log(e);
        })

        
        
      }
      
    })

</script>

@endsection