<?php
  require_once("controller/correo.controller.php");
  $correo = new correoController();
  $detalleMensaje = $correo->Mensaje($pid);
?>

<section id="wrap-container">
<div class="row container-fluid">

  <div class="offset-l1 col m9 " id="wrap-login">
    <h5>Responder Mensaje</h5>
    <hr>
    <div class="right-align">
      <a href="mis-mensajesisset">Volver a mis mensajes</a>
    </div>
    <form class="row" enctype="multipart/form-data" action="enviar-mensaje" method="post" data-parsley-validate id="poemas">
      <input type="hidden" id="txt_destinatario_email" name="data[0]" value="<?php echo $detalleMensaje['poet_email'];?>">

      <div class="input-field col s12">
        <input id="txt_asunto" name="data[1]" readonly value="RE: <?php echo $detalleMensaje['corr_asunto']?>" type="text" required autocomplete="off">
        <label for="txt_asunto">Asunto</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_de" name="data[2]" disabled value="<?php echo $_SESSION["poeta"]["poet_nick"]." (".$_SESSION["poeta"]["poet_email"].")"?>" type="text" required autocomplete="off">
        <label for="txt_de">De</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_destinatario" name="data[3]" value="<?php echo $detalleMensaje['poet_nick'] . " (".$detalleMensaje['poet_email'].")"?>" type="text" required autocomplete="off">
        <label for="txt_destinatario">Para</label>
      </div>

      <div class="input-field col s12">
        <label for="txt_contenido">Responte el mensaje</label><br>
        <textarea rows="20" name="data[4]" id="txt_contenido" required><?php echo "<br><br>El ". $detalleMensaje['corr_fecha_envio']  .", ". $detalleMensaje['poet_nick'] . " (".$detalleMensaje['poet_email'].") Escribio:<br>"  .$detalleMensaje['corr_mesaje']?></textarea>
      </div>

      <div class="input-field col m12" style="margin-bottom:20px">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >Enviar Mensaje</button>
      </div>

    </form>
  </div>
</div>
</section>
