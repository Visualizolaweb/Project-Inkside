<?php
  require_once("controller/poetas.controller.php");
  $poetas = new PoetasController();
  $admins = $poetas->poetasRol("Administrador");
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
        <input id="txt_asunto" name="data[1]" type="text" required autocomplete="off">
        <label for="txt_asunto">Asunto</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_de" name="data[2]" readonly value="<?php echo $_SESSION["poeta"]["poet_nick"]." (".$_SESSION["poeta"]["poet_email"].")"?>" type="text" required autocomplete="off">
        <label for="txt_de">De</label>
      </div>

      <div class="input-field col s12 ui-widget">
        <select id="txt_destinatario" name="data[0]" required>
          <option value="">Selecciona</option>
          <?php
              foreach ($admins as $value) {
                if($value['poet_email']!='webmaster@inksidepoesia.com'){
                  echo "<option value=".$value['poet_email'].">".$value['poet_nick']." (".$value['poet_email']."), Administrador (webmaster@inksidepoesia.com)</option>";
                }else{
                  echo "<option value=".$value['poet_email'].">".$value['poet_nick']." (".$value['poet_email'].")</option>";
                }
              }
          ?>
        </select>
        <label for="txt_destinatario">Para</label>
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
