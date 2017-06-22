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
                echo '<li>
                  <div class="collapsible-header">
                    <div class="chip">
                      <img src="views/assets/images/perfil/img_default.png" alt="Contact Person">
                      '.$mensajes['corr_email_destino'].'
                    </div>
                    '.$mensajes['corr_asunto'].'
                  </div>
                  <div class="collapsible-body"><span>'.$mensajes['corr_mesaje'].'</span></div>
                </li>';
              }
          ?>
        </ul>
      </div>
    </div>
</section>
