@extends ('layouts.admin')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('content')

@section('navigation')
  <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item active" aria-current="page">Total votos</li> 
  </ol>
@endsection

    
<div class="container-fluid">
    <div v-cloak class="row">
        <div class="col">
            <div class="alert alert-primary" role="alert">
            Total votos registrados: <strong> @{{total_votos}} </strong>
            </div>
        </div>
        <div class="col">
        <p class="text-end fs-5">Filtrar por: </p>
        </div>
        <div v-cloak class="col">
                <select class="form-select" v-model="category">
                        <option value="">Todos</option>
                        <option v-for="(organo,index) in organos" :key="organo.index" :value="organo.nombre">@{{organo.nombre}}</option>
                        
                </select> 
        </div>
    </div>
    

    <div v-cloak class="alig-items-center row row-cols-md-3 g-5 mt-2">
    
    <div v-for="(votos, index) in filterByCategory" :key="votos.index">

    <div class="card shadow">
      <div class="card-body">
        <h5 class="card-title font-weight-bold">@{{votos.nombre}} @{{votos.apellido}}</h5>
        <p class="card-text">@{{votos.organo_nombre}}</p>
        <div class="d-flex justify-content-between">
          <p class="display-1 degree ">@{{votos.votos}}</p>
          <i class="fas fa-sun-o fa-5x pt-3 text-warning"></i>
        </div>
        
        <div class="progress">
          <div class="progress-bar bg-black" role="progressbar" style="width: 80%;" aria-valuenow="40"
            aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        
        <hr />
        <a class="btn btn-outline-dark p-md-2 my-1"  href="#">Ver más</a>
      </div>
    </div>

   
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
          category: '',
          votos_candidatos: [],
          total_votos: null,
          organos: []
        }
      },
      mounted(){
        axios.get('/api/total')
        .then((res)=>{
            this.votos_candidatos=res.data.votos_candidatos
            this.total_votos=res.data.total_votos[0].total_votos
            this.organos=res.data.organos
            console.log(this.organos);
            console.log(this.votos_candidatos);
        })
        .catch((e)=>{
            console.log(e);
        })
      },
      computed: {
            filterByCategory(){
                return this.votos_candidatos.filter(votos => !votos.organo_nombre.indexOf(this.category))
            }
        }
    })
</script>



@endsection