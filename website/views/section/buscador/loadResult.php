<?php
   require_once 'website/controller/buscador.controller.php';
   require_once 'website/controller/publicaciones.controller.php';
   $buscador = new BuscadorController();
   $publicaciones = new PublicacionesController();

   $resultado = $buscador->buscarGlobal(htmlentities($_GET["search"]));

   foreach ($resultado as $tipoResultado) {
     if($tipoResultado["type"] == 'Poeta'){
        $resultadoPoeta[] = $tipoResultado;
     }else{
       $resultadoPoema[] = $tipoResultado;
     }
   }

   if(!isset($resultadoPoema)){
     $resultadoPoema = array();
   }

   if(!isset($resultadoPoeta)){
     $resultadoPoeta = array();
   }


?>

<section class="sec-publicaciones secundary-default">
  <div class="container wrap">
    <h1>Resultados de "<?php echo $_GET['search']?>"</h1>
    <h6>El siguiente resultado muestra: los poetas, publicaciones por poeta y publicaciones con la palabra <em>"<?php echo $_GET['search']?>"</em>.</h6>
    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a href="#test1"><i class="fa fa-newspaper-o"></i> Publicaciones (<?php echo count($resultadoPoema)?>)</a></li>
          <li class="tab col s3"><a class="active" href="#test2"><i class="fa fa-user"></i> Poetas (<?php echo count($resultadoPoeta)?>)</a></li>
        </ul>

        <div id="test1" class="col s12">
        <section class="pinBoot">
            <?php
                   foreach ($resultadoPoema as $row) {
                     if ($row['pdesc_avatar']=='') {
                       $delimitador = explode("/",$row['poet_foto']);
                       if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
                         $avatar = $row['poet_foto'];
                       }else{
                         $avatar = "cloud/".$row['poet_foto'];
                       }
                     }else{
                       $avatar = 'cloud/'.$row['pdesc_avatar'];
                     }

                     if(isset($row['Campo3'])){
                       $image = "cloud/views/assets/images/portadasPoemas/".$row['Campo3'];
                       if(file_exists($image)){
                         $portada = '<img src="'.$image.'" alt="'.$row['Campo4'].'">';
                       }else{
                         $portada = "";
                       }
                     }else{
                       $portada = "";
                     }

                     $contenido = $publicaciones->getSubString($row['Campo2']);    ?>

            <article class="white-panel">
              <?php echo $portada; ?>
              <h2><a href="pubID<?php echo $row['Campo1']; ?>"><?php echo $row['Campo4'];?></a></h2>
              <span class="date">Publicado el <?php echo $publicaciones->fechaesp($row['Campo5']); ?></span>
              <p><?php echo $contenido ?>
                  <div class="more"><a href="pubID<?php echo $row['Campo1']; ?>" class="read-more">Seguir Leyendo</a></div>
              </p>
              <div class="bypoeta">
                <img src="<?php echo $avatar; ?>" class="circle"/>
                <h3><?php echo $row['poet_nick']?></h3>
              </div>
            </article>
            <?php } ?>

        </section>
        </div>

        <div id="test2" class="col s12">
        <section class="pinBoot">
          <?php

          foreach ($resultadoPoeta as $row) {
             $contenido = $publicaciones->getSubString($row['Campo2']);

            if ($row['pdesc_avatar']=='') {
              $delimitador = explode("/",$row['poet_foto']);
              if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
                $avatar = $row['poet_foto'];
              }else{
                $avatar = "cloud/".$row['poet_foto'];
              }
            }else{
              $avatar = 'cloud/'.$row['pdesc_avatar'];
            }
            echo '<article class="community-panel">
                  <div class="profile-image circle"><img src="'.$avatar.'" alt="'.$row['poet_nick'].'" /></div>
                    <h3>'.$row['poet_nick'].'</h3>
                    <div class="center-align white-text"><a href="poeta-'.base64_encode($row['Campo1']).'" type="button" class="center waves-effect waves-light btn indigo darken-4 z-depth-0 btn-icon"><i class="fa fa-newspaper-o icon-button orange"></i>Ver Poemas</a></div>
                    <p>'.$contenido.'</p>

                </article>';

          }

          ?>
        </section>
        </div>
      </div>
    </div>

  </div>
</section>
