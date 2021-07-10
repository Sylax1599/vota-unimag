@extends('layouts.app')

@section('css')
<link href="{{ asset('css/cards.css') }}" rel="stylesheet">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<link href="{{ asset('css/success_error_modal.css') }}" rel="stylesheet">

@endsection

@section('content')

<div class="col-auto text-center mt-1 mb-5">
  <h1 class="display-5">
  <?php 
  foreach($organo as $key){
    echo $key->nombre;
  }
  ?>
  </h1>
  

</div>



<div class="container">
   
    <div id="determinado" v-cloak class="alig-items-center row row-cols-md-3 g-5" v-if="!votado">
      

      
          <div v-cloak class="col"  v-for="(candidato, index) in  candidatos" :key="candidato.index">
              <div class="profile-card">
                      <img  :src="`{{ asset('storage/images/${candidato.imagen}') }}`" alt="image1" class="profile-icon" />
                      <div class="profile-name">@{{candidato.nombre}} @{{candidato.apellido}}</div>
                      <div class="profile-position"># @{{candidato.numero_tarjeton}}</div>
                      <button type="button" @click="showModal(candidato.id, candidato.nombre)" class="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="@candidato.id" data-bs-whatever="@candidato.nombre">Votar</button>
              </div>
          </div>
  

    </div>

    <div v-cloak v-else>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </svg>
         <strong class="mr-1">Atención:  </strong> su voto ha sido registrado!
        </h4>
        <hr>
        <p class="mb-0">Usted ya ha votado en este organo</p>
      </div>
    </div>

    

</div>

<!--
  Pagina de error si intenta acceder a través del link a un organo que no existe
 -->
<div v-cloak> 
<div v-if="error" class="alert alert-danger mt-4" role="alert">
    <h4 class="alert-heading d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
        <strong class="mr-1">Atención:  </strong> Error!
    </h4>
  <p>El organo al que intenta acceder, no está disponible!</p>
  <hr> 
  <img src="https://i.pinimg.com/originals/58/a7/0a/58a70a43e7bbd7a33033d02a9261e6f6.gif" alt="" srcset="">
</div>
</div>




<!--
  Icono de carga
 -->
<div v-show="loader" class="preloader">
        <div class="c-three-dots-loader"></div>
</div>


<div class="d-grid gap-2 col-6 mx-auto mt-5 mb-4">
  <a href="/inicio" class="btn btn-outline-dark mt-3" type="button">Volver a inicio</a>
</div>

<!-- Modal de validar contraseña -->
<div class="modal fade" data-bs-backdrop="static" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar voto</h5>
        
      </div>
      <form>
      @csrf
      <div class="modal-body">
      
        <!-- MENSAJE CORRECTO si la contraseña es la correcta -->
        <div class="success">
          <center>
          <h2>Voto registrado con éxito</h2>
          </center>
          <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
          <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
          <span class="swal2-success-line-tip"></span>
          <span class="swal2-success-line-long"></span>
          <div class="swal2-success-ring"></div> 
          <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
          <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
          </div>
        </div>
        <!-- MENSAJE INCORRECTO si la contraseña es la incorrecta -->
        <div class="error">
          <center>
          <h2 class="gray-100">Contraseña incorrecta</h2>
          </center>
          <div class="error swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
            <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
            <span class="swal2-x-mark-line-right"></span>
            </span>
            
          </div>
        </div>

        <!-- FORMULARIO PARA VALIDAR PASSWORD -->
        
          <input type="hidden" name="password" value="{{Auth::user()->password}}">
          <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="mb-3">
              <input type="hidden" name="voto" class="form-control" id="recipient-name">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Confirmar contraseña:</label>
              <input type="password" name="confirm_password" class="form-control" id="message-text"></input>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btnclose" @click="closeModal" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btnenviar">Confirmar voto</button>
      </div>
    
    </form>
  </div>
</div>


@endsection


@section('js')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>



<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<script>


var  link= window.location.pathname;
var separador = link.split('/');


    new Vue({
      el: '#app',
      data(){
        return{
          votado: false,
          candidatos: [],
          candidato_id: null,
          candidato_nombre: null,
          loader: true,
          error: false
        }
      },
      mounted(){
        //API PARA SABER SI HA VOTADO
        axios.get('/api/votado/'+separador[3])
        .then((res)=>{
          this.votado=res.data.votado

          //Si ha votado, entonces el loader lo ocultamos
          if(this.votado)
          this.loader=false
        })
        .catch((e)=>{
          console.log(e);
        }),

        axios.get('/api/votar/'+separador[3])
        .then((res)=>{
          this.candidatos=res.data.candidatos

          //Si no hay candidatos, mostramos la pagina de error
          //Esto es cuando alguien a través del link ingrese un numero 
          if(this.candidatos.length === 0){
            this.error=true
          }
          this.carga()
        })
        .catch((e)=>{
          console.log(e);
        })
      },
      methods:{
        sendinfo(id, nombre){
          this.candidato_id=id
          this.candidato_nombre=nombre
        },
        //Mostrar icono de carga, mientras se consume los datos de la API
        carga(){
          var determinado=document.getElementById('determinado')
          determinado.style.height= 'auto';
          this.loader=false
          
        },

        showModal(id, nombre){
          this.candidato_id=id
          this.candidato_nombre=nombre


          $('#exampleModal').on('shown.bs.modal', function () {
            var modalTitle = exampleModal.querySelector('.modal-title')
            var modalBodyInput = exampleModal.querySelector('.modal-body #recipient-name')

            modalTitle.textContent = 'Confirmar voto para ' + nombre
            modalBodyInput.value = id
          })
        },

        closeModal(){
          this.candidato_id=null
          this.candidato_nombre=null
        }
      }
    })
</script>


<script>


  $(document).ready(function(){



    $.ajaxSetup({
          headers: {
              //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              'X-CSRF-TOKEN': $("input[name=_token]").val()
          }
      });
    
    function ocultar_contenidoModal(){
      $(".mb-3").hide();
    }

    function mostrar_contenidoModal(){
      $(".mb-3").show();
    }
    
    $(".success").hide();
    $(".error").hide();
    
    
    
    $(".btnenviar").click(function(e){
    
    e.preventDefault(); 
    
    var password = $("input[name=password]").val();
    var voto = $("input[name=voto]").val();
    var confirm_password = $("input[name=confirm_password]").val();
    var user_id = $("input[name=user_id]").val();

    $.ajax({
            type:'POST',
            url:"{{ route('registroVoto') }}",
            data:{
                password, 
                voto, 
                confirm_password,
                user_id},
                dataType: "json",
            success:function(data){
                
                if(data.exists){
                    ocultar_contenidoModal();
                    $(".success").show();      
                    $(".btnenviar").hide();

                    $(".btnclose").click(function(e){
                      location.href ="/inicio";
                    });
                  

                  }else{
                    ocultar_contenidoModal();
                    $(".error").show(100,function(){
                      setTimeout(() => {
                        $(".error").hide(); 
                        mostrar_contenidoModal();
                      }, 4000);
                    }
                    );
                  
                  }
            }
          });

  });
  });
    
</script>



@endsection

