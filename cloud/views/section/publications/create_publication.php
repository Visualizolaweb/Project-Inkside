<?php
  require_once("controller/categorias.controller.php");
  $categorias = new categoriasController();
?>

<section id="wrap-container">
<div class="row container-fluid">

  <div class="offset-l1 col m9 " id="wrap-login">
    <h5>Publica un artìculo</h5>
    <p><em>"Crea un articulo que a todos impacte"</em></p>
    <hr>
    <form class="row" enctype="multipart/form-data" action="guardar-articulo" method="post" data-parsley-validate id="poemas">

      <div class="row">
         <div class="file-field input-field">
            <div class="btn">
               <span>Agregar Portada</span>
               <input type="file" name="txt_imgPortada">
            </div>
            <div class="file-path-wrapper">
               <input class="file-path validate" type="text">
            </div>
         </div>
      </div>

      <div class="input-field col s12">
        <input id="txt_titulo" name="data[2]" type="text" required autocomplete="off">
        <label for="txt_titulo">Ponle un título a tu artìculo</label>
      </div>

      <div class="input-field col s12">
        <label for="txt_contenido">Escribe tu Artìculo</label><br>
        <textarea rows="20" name="data[3]" id="txt_contenido" required></textarea>
      </div>

      <div class="input-field col s12">
        <?php $categorias->cargarCategorias(); ?>
      </div>

      <div class="input-field col m12" style="margin-bottom:20px">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >Crear Artìculo</button>
      </div>
    </form>
  </div>
</div>
</section>
