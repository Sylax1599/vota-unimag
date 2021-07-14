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
    <hr>
    <div class="alert alert-success mb-5 mt-2 text-center" role="alert">
    Votos por organos
    </div>
    <pie-chart :data={votos_organos}> </pie-chart>
    <hr>

    
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
          organos: [],
          votos_organos:[],
        }
      },
      
      
      mounted(){
        axios.get('/api/estadisticas/')
        .then((res)=>{
            this.votos_candidatos=res.data.votos_candidatos
            this.total_votos=res.data.total_votos[0].total_votos
            this.organos=res.data.organos
            this.votos_organos=res.data.votos_organos
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
            handler (val) {
                
                this.borrar()
                this.modificado=this.datos.filter(votos => !votos.organo_nombre.indexOf(val))
                this.cargar(this.modificado, val)
                this.datos=this.data.votos_candidatos
            
                
                
            }
        }
        },
        data(){
            return{
                modificado: [],
                categoria: '',
                datos: [],
                etiquetas: [],
                votos: [],
                bgColors: ['rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
        ]
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
            cargar(datos, categoria){
            this.datos=datos
            this.categoria=categoria
            
            this.filterByCategory.forEach(e=>{
            this.etiquetas.push(e.nombre)
            this.votos.push(e.votos)
            })

            this.renderChart({
                labels: this.etiquetas,
                datasets:[{
                    label: 'Total votos',
                    backgroundColor: this.bgColors,
                    data: this.votos,
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 2
                }]
            }, 
            {
                responsive: true, 
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                        stepSize: 1,
                        beginAtZero: true
                        }
                    }]
                },
                animation:{
                    easing: 'easeInBounce',
                    duration: 1000
                }
            
            },
            
            
            )

            

            },

            borrar(){
            
                this.etiquetas.length=0;
                this.votos.length=0;

            }

        

        }
        

    
    })

    Vue.component('pie-chart', {
        extends: VueChartJs.Pie,
        props: ["data"],
        data(){
            return{
                datos: [],
                etiquetas: [],
                votos: [],
                bgColors: ['rgba(255, 99, 132, 0.2)',
                    
                        'rgba(75, 192, 192, 0.2)',
                        
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)']
            }
        },
        mounted(){
            //console.log(this.data);
            this.cargar(this.data)

            
        },

        

        methods:{
            cargar(datos){
            this.datos=datos.votos_organos
            
            this.datos.forEach(e=>{
                this.etiquetas.push(e.nombre)
                this.votos.push(e.votos_organo)
            })

            this.renderChart({
                labels: this.etiquetas,
                datasets:[{
                    label: 'Total votos',
                    backgroundColor: this.bgColors,
                    data: this.votos,
                    borderColor: [
                        'rgb(255, 99, 132)',
                    
                        'rgb(75, 192, 192)',
                    
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 2
                }]
            }, 
            {
                responsive: true, 
                maintainAspectRatio: false,
                animation:{
                    easing: 'easeInOutQuart',
                    duration: 1000
                }
            
            }
            )

            

            }

        

        

        }
        

    
    })


    
</script>

@endsection