<?php
  require_once("controller/categorias.controller.php");
  $categorias = new categoriasController();
?>

<section id="wrap-container">
<div class="row container-fluid">

  <div class=" col m12 " id="wrap-login">
    <div class="col m12 header-section">
      <h5 class="title">Comparte tus Eventos</h5>
      <p><em>Vas a realizar algún evento? compartelo con la comunidad</em></p>
    </div>

    <form class="row" enctype="multipart/form-data" action="guardar-poema" method="post" data-parsley-validate id="poemas">

      <div class="col m4">
         <div class="file-field input-field">
            <div class="btn z-depth-0" style="margin-top: 4px;">
               <span>Agregar Portada</span>
               <input type="file" name="txt_imgPortada">
            </div>
            <div class="file-path-wrapper">
               <input class="file-path validate" type="text">
            </div>
         </div>
      </div>

      <div class="input-field col m4">
        <input id="txt_titulo" name="data[2]" type="text" required autocomplete="off">
        <label for="txt_titulo">Ponle un título a tu evento</label>
      </div>

      <div class="input-field col m4">
        <input id="txtfechaini" type="text" class="datepicker">
        <label for="txtfechaini">Fecha del evento</label>
      </div>
      <div class="input-field col s12">
        <label for="txt_contenido">Cuentanos un resumen del evento, dia, hora, precio y lugar. </label><br>
        <textarea rows="20" name="data[3]" id="txt_contenido" required></textarea>
        <input type="hidden" name="data[777]" value="Evento" />
      </div>

      <div class="input-field col s12" id="categorias">
        <input type="hidden" name="cat[]" value="25">
      </div>

      <div class="input-field col m12" style="margin-bottom:20px">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >Crear Evento</button>
      </div>
    </form>
  </div>
</div>
</section>
