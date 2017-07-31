<?php
   require_once 'controller/poetas.controller.php';
   require_once 'controller/publicaciones.controller.php';
   require_once 'controller/seguidores.controller.php';

  //  CARGAMOS LOS DATOS DEL POETA
  $codpoet = base64_decode($_GET['codpoet']);

  $poeta = new PoetasController();
  $seguidores = new SeguidoresController();

  $perfil = $poeta->buscarDatoPoeta($codpoet);
  $seguidos = $seguidores->yoSigo($_SESSION["poeta"]["poet_codigo"]);

  $seguidos = explode(",",$seguidos["seg_seguidores"]);
 
  foreach ($seguidos as $key) {

    if($codpoet == $key){
      $button = '<a href="javascript:void(0)" onClick="nosigo(\''.$_SESSION["poeta"]["poet_codigo"].'\',\''.$perfil["poet_codigo"].'\')" class=" btnseguirpoeta waves-effect waves-light btn center blue-grey lighten-3" style="display:block">Dejar de Seguir</a>';
      break;
    }else{
      $button = '<a href="javascript:void(0)" onClick="seguir_poeta(\''.$_SESSION["poeta"]["poet_codigo"].'\',\''.$perfil["poet_codigo"].'\')" class=" btnseguirpoeta waves-effect waves-light btn center" style="display:block">+ Seguir Poeta</a>';
    }
  }

  if ($perfil['pdesc_avatar']=='') {
    $delimitador = explode("/",$perfil['poet_foto']);
    if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
      $avatar = $perfil['poet_foto'];
    }else{
      $avatar = "".$perfil['poet_foto'];
    }
  }else{
    $avatar = ''.$perfil['pdesc_avatar'];
  }

  $numeroSeguidores = $poeta->cargaSeguidores($codpoet);

  //  CARGAMOS LAS PUBLICACIONES DEL POETA
  $publicaciones = new PublicacionesController();
  $totalPoemas =  $publicaciones->cuentaPoemasporPoeta($codpoet);
  $cantRegistros = 21;

  $pagina = @$_GET["pagina"];
  if (!$pagina) {
     $inicio = 0;
     $pagina = 1;
  } else {
     $inicio = ($pagina - 1) * $cantRegistros;
  }

  $total_paginas = ceil($totalPoemas / $cantRegistros);

  $poemas = $publicaciones->poemasporPoeta($inicio,$cantRegistros,$codpoet);
  $paginador = true;
?>

<script> document.title = 'Conoce los poemas de <?php echo $perfil['poet_nick']; ?>'; </script>

<section id="wrap-container">
  <div class="row container-fluid">
    <div class="col m12 header-section detail-poet">
        <h5 class="title"><?php echo $perfil['poet_nick']?></h5>
        <div class="row">
          <div class="col m2 profile-poet"><img src="<?php echo $avatar ?>" class="circle" alt="<?php echo $perfil['poet_nick']; ?>"></div>

          <div class="col m10"><?php echo $perfil['pdesc_acerca']?>
          </div>

        </div>
    </div>
    <?php echo $button; ?>
    <div class="sec-publicaciones  comunity ">

    <div class="row">
        <section class="pinBoot">
          <?php
                 foreach ($poemas as $row) {
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

                   if(isset($row['pub_imgPortada'])){
                     $image = "cloud/views/assets/images/portadasPoemas/".$row['pub_imgPortada'];
                     if(file_exists($image)){
                       $portada = '<img src="'.$image.'" alt="'.$row['pub_titulo'].'">';
                     }else{
                       $portada = "";
                     }
                   }else{
                     $portada = "";
                   }

                   $contenido = $publicaciones->getSubString($row['pub_contenido']);    ?>

                <article class="white-panel">
                  <?php echo $portada; ?>
                  <h2><a href="pubID<?php echo $row['pub_codigo']; ?>"><?php echo $row['pub_titulo'];?></a></h2>
                  <span class="date">Publicado el <?php echo $publicaciones->fechaesp($row['pub_fechaPublicacion']); ?></span>
                  <p><?php echo $contenido ?>
                      <div class="more"><a href="pubID<?php echo $row['pub_codigo']; ?>" class="read-more">Seguir Leyendo</a></div>
                  </p>
                </article>
          <?php } ?>

        </section>
      <?php
          if(isset($paginador)){
            if($paginador == true){

            echo '<p><hr></p>
           <div style="width:100%; text-align:center;">';
           //si posicion es mayor o igual a 1 quiere decir que muestre la parte Primero y Anterior de la paginación
           if ($pagina >= 1) {
             $url = "index.php?c=views&a=cargarPublicacion&pagina=0";
             echo "<a href=\"$url\">Primero</a>\n";
             //para que el preius no termine con valor 0
              $url = "index.php?c=views&a=cargarPublicacion&pagina=" .($pagina-1);
             echo "<a href=\"$url\">Anterior</a>\n";
           }

           echo '<strong> Página '.($pagina).' de '.$total_paginas.' </strong>';

           //si position es menor a el valor entre los parentesis muestra la parte (Siguiente Ultimo)
           if ($pagina < ($total_paginas-1)) {

             $url = "index.php?c=views&a=perfilPoeta&codpoet=".$_GET['codpoet']."&pagina=" . ($pagina+1);
             echo "<a href=\"$url\">Siguiente</a>\n";
             $url = "index.php?c=views&a=perfilPoeta&codpoet=".$_GET['codpoet']."&pagina=" . ($total_paginas-1);
             echo "<a href=\"$url\">Ultimo</a>\n";
           }
           echo '</div>';
          }
        }
      ?>
    </div>

</div>

  </div>
</section>
