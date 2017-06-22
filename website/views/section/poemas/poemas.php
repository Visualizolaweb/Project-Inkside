<?php
   require_once 'website/controller/publicaciones.controller.php';
   $publicaciones = new PublicacionesController();
?>
<section class="sec-publicaciones secundary-default">
  <div class="container">
      <h1>Publicaciones de la comunidad</h1>

      <div class="row">
        <?php
           $poemas = $publicaciones->poemas();
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
             $contenido = $publicaciones->getSubString($row['pub_contenido']);
             echo '<div class="col s12 m6 l4 panel">
               <div class="white">
                 <h2>'.$row['pub_titulo'].'</h2>
                 <span class="date">Publicado el '.$publicaciones->fechaesp($row['pub_fechaPublicacion']).'</span>
                 <article>
                 '.$contenido.'
                 <div class="more"><a href="pubID'.$row['pub_codigo'].'" class="read-more">Seguir Leyendo</a></div>
                 </article>
                 <div class="bypoeta">
                     <img src="'.$avatar.'" class="circle"/>
                     <h3>'.$row['poet_nick'].'</h3>
                 </div>
               </div>
             </div>';
           }
        ?>

      </div>
  </div>
</section>
