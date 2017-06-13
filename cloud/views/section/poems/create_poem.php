<?php
  require_once("controller/categorias.controller.php");
  $categorias = new categoriasController();
?>

<section id="wrap-container">
<div class="row container-fluid">

  <div class="col m12 " id="wrap-login">
    <div class="col m12 header-section">
      <h5 class="title">Crea tu poema</h5>
      <p><em>"No existen más que dos reglas para escribir: tener algo que decir y decirlo" — Oscar Wilde</em></p>
    </div>

    <form class="row" enctype="multipart/form-data" action="guardar-poema" method="post" data-parsley-validate id="poemas">

    <div class="col m6">
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

      <div class="input-field col m6">
        <input id="txt_titulo" name="data[2]" type="text" required autocomplete="off">
        <label for="txt_titulo">Bautizalo</label>
      </div>
 
      <div class="input-field col s12">
        <label for="txt_contenido">Inspirate y escribe</label><br>
        <textarea rows="20" name="data[3]" id="txt_contenido" required></textarea>
      </div>

      <input id="txt_audio" type="hidden" name="data[4]" autocomplete="off">

      <div class="input-field col s12" id="categorias">
        <?php $categorias->cargarCategorias(); ?>
      </div>

      <div class="input-field col m12" style="margin-bottom:20px">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >Crear Poema</button>
      </div>


    </form>
  </div>
</div>
</section>
