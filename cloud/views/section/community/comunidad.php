<?php
  require_once("controller/seguidores.controller.php");
  require_once("controller/poemas.controller.php");
  $seguidores = new SeguidoresController();

  $poemasContent = $seguidores->Comunidad();
?>
<section id="wrap-container" class="sec-publicaciones">
  <div class="row container-fluid wrap-panes">
    <div class="col l12">
      <!-- Widget - Bienvenido -->
      <div class="row">
        <div class="col m12 header-section">
          <h5 class='title'>Comunidad de Escritores InkSide </h5>
        </div>
      </div>

        <div class="row container-fluid wrap-panes">
          <div id="poetas" class="col s12">
            <section  class="pinBoot">
              <?php
                foreach ($poemasContent as $publicacion) {
                    $contenidoPet = PoemasController::getSubString($publicacion['pdesc_acerca']);

                    if ($publicacion['pdesc_avatar']=='') {
                      $delimitador = explode("/",$publicacion['poet_foto']);
                      if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
                        $avatar = $publicacion['poet_foto'];
                      }else{
                        $avatar = $publicacion['poet_foto'];
                      }
                    }else{
                      $avatar = $publicacion['pdesc_avatar'];
                    }
                  echo '
                              <article class="community-panel">
                                <div class="profile-image circle"><img src="'.$avatar.'" alt="'.$publicacion['poet_nick'].'" /></div>
                                <h3>'.$publicacion['poet_nick'].'</h3>
                                <div class="center-align white-text"><a href="poeta-'.base64_encode($publicacion['codigo']).'" type="button" class="center waves-effect waves-light btn indigo darken-4 z-depth-0 btn-icon"> Ver Poemas</a></div>
                                <p>'.$contenidoPet.'</p>
                              </article>';
                }
              ?>
            </section>
        </div>
      </div>
    </div>
  </div>
</section>
