<?php
  require_once("controller/poetas.controller.php");
  require_once("controller/seguidores.controller.php");

  $seguidores = new SeguidoresController();
  $sigoa    = $seguidores->yoSigo($_SESSION["poeta"]["poet_codigo"]);
  $comunidad = $seguidores->miComunidad( $sigoa["seg_seguidores"]);


?>

<section id="wrap-container">
<div class="row container-fluid">

  <div class="offset-l1 col m9 " id="wrap-login">
    <h5>Escribir nuevo mensaje</h5>
    <hr>
    <div class="right-align">
      <a href="mis-mensajesisset">Volver a mis mensajes</a>
    </div>
    <form class="row" enctype="multipart/form-data" action="enviar-mensaje" method="post" data-parsley-validate id="poemas">

      <div class="input-field col s12">
        <input id="txt_de" name="data[2]" readonly value="<?php echo $_SESSION["poeta"]["poet_nick"]." (".$_SESSION["poeta"]["poet_email"].")"?>" type="text" required autocomplete="off">
        <label for="txt_de">De</label>
      </div>


      <div class="input-field col s12 ui-widget">
        <select id="txt_destinatario" name="data[0]" required>
          <option value="">Selecciona un destinatario</option>
          <option value="jaolopez@gmail.com">Administrador Inkside</option>
          <?php
              foreach ($comunidad as $value) {
                echo '<option value="'.$value["poet_email"].'">'.$value["poet_nick"].'</option>';
              }
          ?>
        </select>
        <label for="txt_destinatario">Para</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_asunto" name="data[1]" type="text" required autocomplete="off">
        <label for="txt_asunto">Asunto</label>
      </div>

      <div class="input-field col s12">
        <label for="txt_contenido">Escribir mensaje</label><br>
        <textarea rows="20" name="data[4]" id="txt_contenido" required></textarea>
      </div>

      <div class="input-field col m12" style="margin-bottom:20px">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >Enviar Mensaje</button>
      </div>

    </form>
  </div>
</div>
</section>
