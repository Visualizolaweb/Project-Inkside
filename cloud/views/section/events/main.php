<?php
  require_once("controller/publicaciones.controller.php");
  $publicaciones = new publicacionesController();
  // $poemasContent = $poemas->poemas();
?>
<section id="wrap-container">
  <div class="row container-fluid wrap-panes">
      <div class="col l12">

        <!-- Widget - Bienvenido -->
        <div class="col m12 header-section">
          <h5 class="title">Encuentra todos los poemas de la comunidad</h5>
        </div>


        <!-- Widget - Poemas -->

          <div id="content">
            <?php
                $publicaciones->paginarPublicaciones();
            ?>
          </div>


      </div>


    </div>
</section>
