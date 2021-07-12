@extends ('layouts.admin')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('content')

@section('navigation')
  <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item active" aria-current="page">Graficos</li> 
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

    
    
    <line-chart :category=category :data={votos_candidatos}> </line-chart>

    
</div>

@endsection


@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>

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
        })
        .catch((e)=>{
            console.log(e);
        })
      },
      
})

    Vue.component('line-chart', {
    extends: VueChartJs.Bar,
    props: ["data", "category"],
    watch:{
        category: {
            deep: true,
        handler (val, oldVal) {
            
            this.borrar()
            this.modificado=this.datos.filter(votos => !votos.organo_nombre.indexOf(val))
            this.cargar(this.modificado, val)
            this.datos=this.data.votos_candidatos
            console.log(this.modificado, val);
            
            
        }
    }
    },
    data(){
        return{
            modificado: [],
            categoria: '',
            datos: [],
            etiquetas: [],
            stock: [],
            bgColors: ['#ea80fc', '#e040fb', '#d500f9', '#aa00ff']
        }
    },
    mounted(){
        this.cargar(this.data.votos_candidatos,this.category)

        
    },

    computed: {
        filterByCategory(){
            return this.datos.filter(votos => !votos.organo_nombre.indexOf(this.categoria))
        }
    },

    methods:{
        cargar(prueba_datos, prueba_categoria){
        this.datos=prueba_datos
        this.categoria=prueba_categoria
        
        this.filterByCategory.forEach(e=>{
           this.etiquetas.push(e.nombre)
           this.stock.push(e.votos)
        })

        this.renderChart({
            labels: this.etiquetas,
            datasets:[{
                label: 'Total votos',
                backgroundColor: this.bgColors,
                data: this.stock,
                borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        }, {responsive: true, maintainAspectRatio: false})

        

        },

        borrar(){
           
            this.etiquetas.length=0;
            this.stock.length=0;

        }

       

    }
    

    
    })


    
</script>

@endsection