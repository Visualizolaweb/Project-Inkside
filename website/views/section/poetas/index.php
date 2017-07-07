<?php
   require_once 'website/controller/poetas.controller.php';
   require_once 'website/controller/publicaciones.controller.php';

  //  CARGAMOS LOS DATOS DEL POETA
  $poet_codigo = base64_decode($_GET['codpoet']);

  $poeta = new PoetasController();
  $perfil = $poeta->buscarDatoPoeta($poet_codigo);

  if ($perfil['pdesc_avatar']=='') {
    $delimitador = explode("/",$perfil['poet_foto']);
    if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
      $avatar = $perfil['poet_foto'];
    }else{
      $avatar = "cloud/".$perfil['poet_foto'];
    }
  }else{
    $avatar = 'cloud/'.$perfil['pdesc_avatar'];
  }

  $numeroSeguidores = $poeta->cargaSeguidores($poet_codigo);

  //  CARGAMOS LAS PUBLICACIONES DEL POETA
  $publicaciones = new PublicacionesController();
  $totalPoemas =  $publicaciones->cuentaPoemasporPoeta($poet_codigo);
  $cantRegistros = 21;

  $pagina = @$_GET["pagina"];
  if (!$pagina) {
     $inicio = 0;
     $pagina = 1;
  } else {
     $inicio = ($pagina - 1) * $cantRegistros;
  }

  $total_paginas = ceil($totalPoemas / $cantRegistros);

  $poemas = $publicaciones->poemasporPoeta($inicio,$cantRegistros,$poet_codigo);
  $paginador = true;
?>

<script> document.title = 'Conoce los poemas de <?php echo $perfil['poet_nick']; ?>'; </script>
<div class="container detail-poet">
  <section class="profile row">
    <div class="col s12 m3 l3 center-align"> <img src="<?php echo $avatar ?>" class="circle" alt="<?php echo $perfil['poet_nick']; ?>"> </div>
    <div class="col s12 m9 l9">
      <div class="row">
        <div class="col s12"><h1><?php echo $perfil['poet_nick']?></h1></div>
        <div class="col m6 hide-on-small-only"><button onclick="followPoet()" type="button" class="center waves-effect waves-light btn amber accent-3 z-depth-0 btn-icon"><i class="fa fa-plus icon-button orange"></i>Seguir al poeta</button></div>
        <div class="col m6 hide-on-small-only">
          <ul>
            <li><?php echo $totalPoemas?> Poemas</li>
            <li><?php echo $numeroSeguidores?> Seguidores</li>
          </ul>
        </div>
        <div class="col s12">
          <p><?php echo $perfil['pdesc_acerca']?></p>
        </div>
      </div>
    </div>
  </section>
</div>

<section class="sec-publicaciones secundary-default" style="padding-top:40px">
  <div class="container">
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
</section>

<!-- ESTRUCTURA MODAL SEGUIR POETA -->

<div id="modalFollow" class="modal" style="max-height: 100%;">
  <div class="modal-content">
    <h4>Registrate e inicia sesión en Inkside!</h4>
    <p>Lo sentimos, para seguir un poeta te invitamos a que te registres de forma gratuita en nuestra comunidad.</p>
  </div>
</div>
