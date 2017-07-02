<?php
  require_once("controller/correo.controller.php");
  $correo = new CorreoController();

  $misMensajes = $correo->cargarMensajes();
  $mensajesResult = count($misMensajes);
  if($mensajesResult==0){
    $mensajesResult = 0;
  }

  $sinLeer = $correo->MensajeNoLeidos();

  if(!isset($_SESSION["poeta"]["poet_codigo"])){
     $codigoPoeta = $poetas->cargaCodigoPoeta();
     $_SESSION["poeta"]["poet_codigo"] = $codigoPoeta["poet_codigo"];
  }

    if($_GET['msj'] == "true"){
      $msj = "Su mensaje ha sido enviado exitosamente";
    }elseif($_GET['msj'] == "false"){
      $msj = "Se ha producido un error, intenta nuevamente más tarde";
    }elseif($_GET['msj'] == "trueD"){
      $msj = "Su mensaje ha sido borrado.";
    }

  if($msj!='isset'){
    echo "<script>
          window.onload = function(){
              loadToast('$msj');
          }</script>";
  }
?>
<section id="wrap-container">
  <div class="row container-fluid wrap-panes">

      <div class="col l12">
        <!-- Widget - Mensajes -->
        <div class="col m12 header-section">
          <h5 class="title">Mis mensajes</h5>
          <p class="col m6">
            <em>Mi bandeja de entrada (<?php echo $mensajesResult;?> mensajes, <?php echo $noLeidos;?> sin leer)</em>
          </p>
          <p  class="col m6 right-align">
            <a href="nuevo-mensaje">
              <i class="fa fa-envelope-open-o" aria-hidden="true"></i> Nuevo Mensaje
            </a>
          </p>
        </div>
          <?php
            if($_SESSION["poeta"]["poet_email"]!=""){
              echo '<ul id="resultado" class="collapsible" data-collapsible="accordion">';
              foreach ($misMensajes as $mensajes) {
                if (strlen($mensajes['corr_codigo'])==1) {
                  $mensaje_codigo = '0'.$mensajes['corr_codigo'];
                } else {
                  $mensaje_codigo = $mensajes['corr_codigo'];
                }

                if($mensajes['pdesc_avatar']!=''){
                  $avatar = $mensajes['pdesc_avatar'];
                }else{
                  $avatar = $mensajes['poet_foto'];
                }


                echo '<li>
                  <div class="collapsible-header"  id="'.$mensaje_codigo.'" onClick="cambiarEstado('.$mensaje_codigo.')">';
                  if($mensajes['corr_estado']==0){
                    echo '<div class="chip" >
                      <img src="'.$avatar.'" alt="'.$mensajes['poet_nick'].'">
                      '.$mensajes['poet_nick'].'
                    </div>
                      <span class="unread"> '.$mensajes['corr_asunto'].'</span>
                      <label class="unread"><em>'.$mensajes['corr_fecha_envio'].'</em> <i class="fa fa-envelope-o" aria-hidden="true"></i></label>';
                  }else{
                    echo '<div class="chip">
                      <img src="'.$avatar.'" alt="'.$mensajes['poet_nick'].'">
                      '.$mensajes['poet_nick'].'
                    </div>
                      '.$mensajes['corr_asunto'].'
                      <label><em>'.$mensajes['corr_fecha_envio'].'</em><i class="fa fa-envelope-open-o" aria-hidden="true"></i></label>';
                  }
                  echo '</div>
                  <div class="collapsible-body">
                    <div class="right-align">
                        <a href="responder-pubID'.$mensaje_codigo.'"><i class="fa fa-reply" aria-hidden="true"> Responder</i></a>
                        <a href="eliminar-mensaje'.$mensaje_codigo.'"><i class="fa fa-times" aria-hidden="true"> Eliminar</i></a>
                    </div>
                    <span>'.$mensajes['corr_mesaje'].'</span>
                    <div class="right-align">
                        <a href="responder-pubID'.$mensaje_codigo.'"><i class="fa fa-reply" aria-hidden="true"> Responder</i></a>
                        <a href="eliminar-mensaje'.$mensaje_codigo.'"><i class="fa fa-times" aria-hidden="true"> Eliminar</i></a>
                    </div>
                  </div>
                </li>';
              }
              echo "</ul>";
            }else{
              echo '<p>No tienes mensajes en la bandeja de entrada.</p>';

            }
          ?>
      </div>
    </div>
</section>
