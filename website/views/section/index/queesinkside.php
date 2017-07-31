<?php
   require_once 'website/controller/publicaciones.controller.php';
   $publicaciones = new PublicacionesController();
?>
<section class="sec-publicaciones secundary-default">
  <div class="container wrap">
    <h1>Que es Inkside poesía</h1>
    <div class="row">
      <div class="col l12">
        <p>Inkside Poesía es un proyecto constructivista, de comunidad, expresivo, sin límites mas allá de los que ponga la mente  de quien no se atreve a pensar en paralelo, a desafiarse y a leerse.  Nuestro objetivo es brindar el espacio de expresión netamente poética en todas sus formas, tamaños y colores, para que todo el que desee publicar un poema tenga un espacio en donde hacerlo.  En donde convergen los puntos de vista de varios autores para ajustar las creaciones de cada uno y dar avance patentado de los escritos.</p>
        <p>Queremos formar una comunidad de poesía en torno a la verdad existente en cada poema y poeta, que  regulen de manera adecuada la creación y divulgación de este arte en toda la red, que desde todos los rincones del planeta en donde se tenga acceso web, se puedan divulgar y leer los escritos que tenemos guardados y queremos compartir.</p>
        <span>"La poesia la ÚNICA Verdad" - <em>G. Ceratti</em></span>
      </div>
    </div>
  </div>
</section>

<section class="sec-wrap-news primary-default ">
  <div class="container wrap">
    <h2>Noticias y Eventos</h2>
    <div class="row">
      <?php
             $articulos = $publicaciones->articulos();

             if(count($articulos) <= 0){
               echo "<p>Por ahora no hay contendio a mostrar</p>";
             }else{
               echo '<p style="margin-bottom:20px;">Lo último de la actividad literaria y poética en el mundo</p>';
             foreach ($articulos as $row) {
               $conten =  strip_tags($row["pub_contenido"],"<br>");
               $conten =  htmlentities($conten);
               $conten =  str_replace(htmlentities("<br>")," ",$conten);
               $conten =  substr($conten, 0, 200)."...";
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
