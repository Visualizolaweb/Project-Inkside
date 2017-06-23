<?php
   require_once 'website/controller/publicaciones.controller.php';
   $publicaciones = new PublicacionesController();
?>

<section class="sec-publicaciones secundary-default">
  <div class="container wrap">
      <?php

      switch (isset($dataFilter)){
        case 'Poema':
          echo "<h1>Listado de Poemas</h1>";
          echo "<h6>Lee los ultimos poemas de la comunidad.</h6>";

          // CONSTRUCCION DEL PAGINADOR

          // Realizar la consulta para verificar la cantidad de registros
          $totalPoemas =  $publicaciones->cuentaPoemas();
          $cantRegistros = 21;

          $pagina = @$_GET["pagina"];
          if (!$pagina) {
             $inicio = 0;
             $pagina = 1;
          } else {
             $inicio = ($pagina - 1) * $cantRegistros;
          }

          $total_paginas = ceil($totalPoemas / $cantRegistros);

          $poemas = $publicaciones->poemas($inicio,$cantRegistros);
          $paginador = true;
        break;

        default:
          echo "<h1>Publicaciones de la comunidad</h1>";
          echo "<h6>Alguien en la comunidad ha escrito</h6>";
          $poemas = $publicaciones->poemas(0, 12);
        break;
      }

      ?>
      <div class="row">
        <section id="pinBoot">
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
            <div class="bypoeta">
              <img src="<?php echo $avatar; ?>" class="circle"/>
              <h3><?php echo $row['poet_nick']?></h3>
            </div>
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

           $url = "index.php?c=views&a=cargarPublicacion&pagina=" . ($pagina+1);
           echo "<a href=\"$url\">Siguiente</a>\n";
           $url = "index.php?c=views&a=cargarPublicacion&pagina=" . ($total_paginas-1);
           echo "<a href=\"$url\">Ultimo</a>\n";
         }
         echo '</div>';
        }
      }
        ?>
      </div>


  </div>
</section>
