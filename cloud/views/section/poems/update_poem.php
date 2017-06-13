<?php
  require_once("controller/categorias.controller.php");
  $categorias = new categoriasController();

  require_once("controller/publicaciones.controller.php");
  $publicaciones = new PublicacionesController();

  $publicacion =  $publicaciones->cargarPublicacionbyID($_GET["pid"]);
?>

<section id="wrap-container">
<div class="row container-fluid">

  <div class="col m12 " id="wrap-login">
    <div class="col m12 header-section">
      <h5 class="title">Actualiza tu poema </h5>
      <p><em>"No existen más que dos reglas para escribir: tener algo que decir y decirlo" — Oscar Wilde</em></p>
    </div>

    <form class="row"   action="actualizar-poema" method="post" data-parsley-validate id="poemas">

      <div class="input-field col m6">
        <input type="hidden" name="data[0]" value="<?php echo $_GET["pid"];?>">
        <input id="txt_titulo" name="data[2]" type="text" required autocomplete="off" value="<?php echo $publicacion['pub_titulo']; ?>">

      </div>
      <div class="input-field col s6" id="categorias">
        <?php $categorias->actualizaCategorias( $publicacion['catePub_codigo']); ?>
      </div>

      <div class="input-field col s12">
        <label for="txt_contenido">Inspirate y escribe</label><br>
        <textarea rows="20" name="data[3]" id="txt_contenido" required><?php echo $publicacion["pub_contenido"] ?></textarea>
      </div>

      <div class="input-field col m12" style="margin-bottom:20px">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >Actualizar Poema</button>
      </div>


    </form>
  </div>
</div>
</section>
