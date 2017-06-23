<?php
  require_once("controller/correo.controller.php");
  $correo = new CorreoController();
  $misMensajes = $correo->cargarMensajes();

  if(!isset($_SESSION["poeta"]["poet_codigo"])){
     $codigoPoeta = $poetas->cargaCodigoPoeta();
     $_SESSION["poeta"]["poet_codigo"] = $codigoPoeta["poet_codigo"];
  }


?>
<section id="wrap-container">
  <div class="row container-fluid wrap-panes">

      <div class="col l12">
        <!-- Widget - Mensajes -->
        <div class="col m12 header-section">
          <h5 class="title">Mis mensajes</h5>
          <p><em>Mi bandeja de entrada (<?php echo count($misMensajes);?> mensajes)</em></p>
        </div>
        <ul class="collapsible" data-collapsible="accordion">
          <?php
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
                  <div class="collapsible-header">
                    <div class="chip">
                      <img src="'.$avatar.'" alt="Contact Person">
                      '.$mensajes['poet_nick'].'
                    </div>
                      '.$mensajes['corr_asunto'].'
                      <label><em>'.$mensajes['corr_fecha_envio'].'</em></label>
                  </div>
                  <div class="collapsible-body">
                    <span>'.$mensajes['corr_mesaje'].'</span>
                    <div class="right-align">
                        <a href="responder-pubID'.$mensaje_codigo.'"><i class="fa fa-reply" aria-hidden="true"> Responder</i></a>
                        <a href="#"><i class="fa fa-times" aria-hidden="true"> Eliminar</i></a>
                    </div>
                  </div>
                </li>';
              }
          ?>
        </ul>
      </div>
    </div>
</section>
