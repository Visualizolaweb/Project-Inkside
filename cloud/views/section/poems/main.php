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

          <?php

            switch ($tipoArticulo) {
              case 'Poema':
                echo "<h5 class='title'>Encuentra todos los poemas de la comunidad</h5>";
              break;

              case 'Noticia':
                echo "<h5 class='title'>Conoce las ultimas noticias de Inkside</h5>";
              break;

              case 'Evento':
                echo "<h5 class='title'>Asiste a los eventos de nuestros integrantes</h5>";
              break;
            }

           ?>


        </div>


        <!-- Widget - Poemas -->

          <div id="content">
            <?php

                $publicaciones->paginarPublicaciones($tipoArticulo);
            ?>
          </div>


      </div>


    </div>
</section>
