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
  <h1>
  <?php 
  foreach($organo as $key){
    echo $key->nombre;
  }
  ?>
  </h1>
</div>

<div class="container">
    <div class="alig-items-center row row-cols-md-3 g-5" v-if="!votado">
      
      @foreach($candidatos as $candidato)
          <div class="col">
              <div class="profile-card">
                      <img src="https://happytravel.viajes/wp-content/uploads/2020/04/146-1468479_my-profile-icon-blank-profile-picture-circle-hd.png" alt="image1" class="profile-icon" />
                      <div class="profile-name">{{$candidato->nombre}} {{$candidato->apellido}}</div>
                      <div class="profile-position"># {{$candidato->numero_tarjeton}}</div>
                      <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="{{$candidato->id}}" data-bs-whatever="{{$candidato->nombre}}">Votar</button>
              </div>
          </div>
      @endforeach

    </div>

    <div v-else>
      <div class="alert alert-danger text-center" role="alert">
      Usted ya ha votado en este organo!
      </div>
    </div>

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
      
      <!-- MENSAJE CORRECTO -->
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
      <!-- MENSAJE INCORRECTO -->
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

      <!-- FORMULARIO VALIDAR PASS -->
      
        <input type="hidden" name="password" value="{{Auth::user()->password}}">
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">ID:</label>
            <input type="text" name="voto" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Confirmar contraseña:</label>
            <input type="password" name="confirm_password" class="form-control" id="message-text"></input>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btnclose" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btnenviar">Confirmar voto</button>
      </div>
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
console.log(separador[3]);


    new Vue({
      el: '#app',
      data(){
        return{
          votado: false,
        }
      },
      mounted(){
        axios.get('/inicio/votado/'+separador[3])
        .then((r)=>{
          this.votado=r.data.votado
          console.log(r.data);
        })
      },
      methods:{
        prueba(){
          
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

<script type="text/javascript">

    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      var id = button.getAttribute('data-bs-id')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = exampleModal.querySelector('.modal-title')
      var modalBodyInput = exampleModal.querySelector('.modal-body #recipient-name')

      modalTitle.textContent = 'Confirmar voto para ' + recipient
      modalBodyInput.value = id
    })

</script>

@endsection

