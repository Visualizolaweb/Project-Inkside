<?php
   require_once 'website/controller/publicaciones.controller.php';
   $publicaciones = new PublicacionesController();
?>

 <?php require_once("website/views/include/scop-header-banner.php"); ?>
 <?php require_once("website/views/section/publication/loadpublications.php"); ?>

<section class="sec-wrap-news primary-default">
  <div class="container wrap">
    <h2>Artículos, Noticias y Eventos</h2>
    <p>Lo último de la actividad literaria y poética en el mundo</p>
    <div class="row">
      <?php
             $articulos = $publicaciones->articulos();

             if(count($articulos) <= 0){
               echo "<p>Aun no tenemos articulos para mostrar</p>";
             }else{
             foreach ($articulos as $row) {
               $conten = $publicaciones->getSubString($row["pub_contenido"]);
             echo '<div class="col l3">
                     <article>
                       <div class="title label-event">'.$row["pub_categoria"].'</div>

                       <div class="content white">
                         <h4>'.$row["pub_titulo"].'</h4>
                         <p>'.$conten.'</p>
                         <div class="detail"><a href="pubID'.$row['pub_codigo'].'">Ver Mas</a></div>
                       </div>
                     </article>
                   </div>';
             }
           }
      ?>
    </div>
  </div>
</section>
