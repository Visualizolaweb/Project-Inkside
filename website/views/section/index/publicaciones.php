<?php
   require_once 'website/controller/publicaciones.controller.php';
   $publicaciones = new PublicacionesController();
?>
<section class="sec-publicaciones secundary-default">
  <div class="container wrap">
    <h1 style="margin-bottom:30px">Ediciones de Inkside Poesía</h1>
    <div class="row white" style="padding:10px 0;">
      <div class="col l12">
        <div class="row">
          <div class="col l12 edicion-text">
            <h5>Indeleble Poesía SEGMENTO II</h5>
            <ul>
              <li><b>Autor:</b> Comunidad inkside Poesía </li>
            </ul>
            <div class="col l4">
              <img style="margin-top:20px" src="website/views/assets/images/ediciones/tapa_segmentoII_black.png"/>
            </div>

            <div class="col l8 ">
              <p>Esta selección de poemas de la comunidad inkside poesía para su publicación, contiene el trabajo y el pensamiento de algunos miembros de esta comunidad, es un Homenaje a la Palabra para aquellos que no la usan o para quienes la usan mal y especialmente para aquellos que saben cual es su valor. Agradecemos a todos los miembros de la comunidad que han hecho realidad este SEGMENTO II.</p>
              <p>Contiene: 3 Libros "Indeleble Poesía SEGMENTO II" y 1 Afiche conmemorativo</p>
            </div>

            <div class="col l6">
              <h4>PRECIO PREVENTA: <br> 12 USD / 20.000 COP</h4>
            </div>

            <div class="col l6" >
              <a href="solicitar-publicacion"  class="waves-effect waves-light btn white-text " >Solicitar Publicación</a>
            </div>

        </div>

        <div class="col l12 edicion-text">
          <h5>Indeleble Poesía SEGMENTO I</h5>
          <ul>
            <li><b>Autor:</b> Comunidad inkside Poesía </li>
          </ul>
          <div class="col l4">
            <img style="margin-top:20px" src="website/views/assets/images/ediciones/portada_indeleble_poesia.png"/>
          </div>

          <div class="col l8 ">
            <p>La presente selección de poemas comprende un segmento del trabajo que los escritores de la comunidad han cosechado durante los últimos tres años y ha llegado a feliz término al plasmarse en esta, la primera publicación, llamada “Indeleble Poesía (SegmentoI)”.
En este primer asalto poético en equipo, reunimos escritos y escritores de la mayor variedad y temas, así como de estilos y formas, de modo tal que se convierte entonces en un tangram que logra exhibir el carácter que ha creado INKSIDE POESIA como comunidad en todos sus miembros.
Nos atrevemos a esculpir la cara del poeta moderno, lleno de las nuevas herramientas que proporciona la globalidad.</p>

<p>Nos movemos, no tras bambalinas, sino tras cada línea digital escrita en redes sociales; e-mails, blogs, entre otros, para dejar en el mundo huella; ser indeleble y petrificarse en la recordación del mañana.
Rompemos los esquemas tradicionales de publicación de escritos en definitiva, llevando entonces de lo digital a lo real, al menos un ápice de lo que hoy tenemos en la red al alcance de todos, sin
medida alguna. Aventúrese a las distantes esquinas de nuestra lengua y su expresión por excelencia, la poesía plasmada desde las marcadas culturas de cada escritor que convergen en este primer segmento, más no el último de INDELEBLE POESIA...</p>
          </div>

          <div class="col l6">
            <h4>PRECIO: 7 USD</h4>
          </div>

          <div class="col l6" >
            <a  href="solicitar-publicacion" class="waves-effect waves-light btn white-text">Solicitar Publicación</a>
          </div>

      </div>

      <div class="col l12 edicion-text">
        <h5>Entre Pensamientos</h5>
        <ul>
          <li><b>Autor:</b> Julián Osorio López </li>
        </ul>
        <div class="col l4">
          <img style="margin-top:20px" src="website/views/assets/images/ediciones/portada_entre_pensamientos.png"/>
        </div>

        <div class="col l8 ">
          <p>Entre Pensamientos, recoge momentos simples y cotidianos que se quieren presentar para ser usados bajo cualquier pretexto, en cualquier situación y sin exigencia alguna. Con un recorrido temporal de más de diez años entre el primer poema escrito y el último presente, sin ser biográficos o exactos, no pretende graficar la vida misma sino una visión multifacética y atemporal de eventos a compartir.
             Acérquese a este texto con la más tranquila disposición y tenga presente que no hay que figurar en los diarios o noticias, sitios web o e-mail, para verse reflejado en uno de los intensos plasmados en palabras aquí escritas como protagonista o antagonista o quizás simple lector que ve pasar el evento entre cada línea.</p>

          <p>Atrévase con el texto a hacer lo que no ha hecho con otro similar y enfréntese desprevenidamente a usar la poesía de los sentidos en las formas propias y divergentes que mas ocurrencias tengan. Haga con él interpolaciones entre líneas y extrapole fuera de las márgenes del convencionalismo, que viva y sienta cada momento como elaboración no terminada dispuesta a tener alternativas mas allá del simple hecho escrito.</p>
        </div>

        <div class="col l6">
          <h4>PRECIO: 14 USD / Incluye CD</h4>
        </div>

        <div class="col l6" >
          <a  href="solicitar-publicacion" class="waves-effect waves-light btn white-text">Solicitar Publicación</a>
        </div>

    </div>


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
