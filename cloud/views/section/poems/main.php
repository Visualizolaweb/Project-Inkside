<?php
  require_once("controller/publicaciones.controller.php");
  $publicaciones = new publicacionesController();
  // $poemasContent = $poemas->poemas();
?>
<section id="wrap-container">
  <div class="row container-fluid wrap-panes">
      <div class="col l12">

        <!-- Widget - Bienvenido -->
        <div class="panel message">
          <div class="icon-message cyan accent-3"><i class="fa fa-star"></i></div>
          <p>Aquí podrás ver los poemas sugeridos según tus gustos</p>
        </div>

        <!-- Widget - Poemas -->

          <div id="content">
            <?php $publicaciones->paginarPublicaciones(); ?>
          </div>


      </div>


    </div>
</section>
