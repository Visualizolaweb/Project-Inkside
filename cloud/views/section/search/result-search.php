<?php
  require_once("controller/publicaciones.controller.php");
  require_once("controller/poemas.controller.php");
  require_once("controller/poetas.controller.php");

  $publicaciones = new publicacionesController();
  $poemas = new PoemasController();
  $poetasdet = new PoetasController();

  $poemasContent = $publicaciones->Buscador();
  $buscar = $_POST['busqueda'];
?>
<section id="wrap-container" class="sec-publicaciones">
  <div class="row container-fluid wrap-panes">
    <div class="col l12">
      <!-- Widget - Bienvenido -->
      <div class="row">
        <div class="col m12 header-section">
          <h5 class='title'>Resultado de la busqueda para <?php echo $buscar;?></h5>
        </div>
      </div>
        <!-- Widget - Poemas -->
        <div class="row">
          <ul class="tabs">
            <li class="tab col s3"><a href="#poemas">Poemas</a></li>
            <li class="tab col s3"><a class="active" href="#poetas">Poetas</a></li>
          </ul>
        </div>

<?php
$detPoetas = '';
$poemas = '';
foreach ($poemasContent as $publicacion) {
  if($publicacion['type']=='Poeta'){
    $detPoeta = $poetasdet->buscarDatoPoetaInner($publicacion['codigo']);
    $contenidoPet = PoemasController::getSubString($detPoeta['pdesc_acerca']);

    if ($detPoeta['pdesc_avatar']=='') {
      $delimitador = explode("/",$detPoeta['poet_foto']);
      if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
        $avatar = $detPoeta['poet_foto'];
      }else{
        $avatar = $detPoeta['poet_foto'];
      }
    }else{
      $avatar = $detPoeta['pdesc_avatar'];
    }

   $detPoetas .= '<article class="community-panel">
                    <div class="profile-image circle"><img src="'.$avatar.'" alt="'.$detPoeta['poet_nick'].'" /></div>
                    <h3>'.$detPoeta['poet_nick'].'</h3>
                    <p>'.$contenidoPet.'</p>
                  </article>';

  }elseif($publicacion['type']=='Poema'){

    $contenido = PoemasController::getSubString($publicacion["campoc"]);

    $complPub = $publicaciones->cargarPublicacionbyID($publicacion['codigo']);

    if ($complPub['pdesc_avatar']=='') {
      $delimitador = explode("/",$complPub['poet_foto']);
      if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
        $avatar = $row['poet_foto'];
      }else{
        $avatar = $complPub['poet_foto'];
      }
    }else{
      $avatar = $complPub['pdesc_avatar'];
    }

    if(isset($complPub['pub_imgPortada'])){
      $image = "views/assets/images/portadasPoemas/".$complPub['pub_imgPortada'];
      if(file_exists($image)){
        $portada = '<img src="'.$image.'" alt="'.$complPub['pub_titulo'].'">';
      }else{
        $portada = "";
      }
    }else{
      $portada = "";
    }

    $poemas .= '<article class="white-panel">
             '. $portada . '
             <h2><a href="pubID' . $publicacion['codigo'] . '">'. $publicacion['campoa'] . '</a></h2>
             <p>' . $contenido .'
                <div class="more">
                  <a href="pubID' . $publicacion['codigo'] .' class="read-more">Seguir Leyendo</a>
                </div>
             </p>
             <div class="bypoeta">
              <img src="'. $avatar.'" class="circle"/>
               <h3>'. $complPub['poet_nick'].'</h3>
             </div>
          </article>';
    }
}
?>
        <div class="row">
          <div id="poemas" class="col s12">
            <section  class="pinBoot">
              <?php
                echo $poemas;
              ?>
            </section>
          </div>
          <div id="poetas" class="col s12">
            <section class="pinBoot">
              <?php echo $detPoetas;?>
            </section>
          </div>
      </div>
    </div>
  </div>
</section>
