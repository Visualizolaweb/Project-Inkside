<?php
   require_once 'website/controller/publicaciones.controller.php';
   require_once 'website/controller/localizacion.controller.php';
   $publicaciones = new PublicacionesController();
   $localizacion  = new LocalizacionController();
?>
<section class="sec-publicaciones secundary-default">
  <div class="container wrap">
    <h1 style="margin-bottom:30px">Solicita las publicaciones Inkside Poesía a través del siguiente formulario.</h1>
    <div class="row  " style="padding:10px 0;">
      <div class="col l12">
        <div class="row">

          <form class="row" action="ediciones-inkside" method="post">
            <div class="input-field col s12 m6">
              <input id="last_name" type="text" class="validate" required>
              <label for="last_name">Nombre *</label>
            </div>
            <div class="input-field col s12 m6">
              <input id="last_name" type="text" class="validate" required>
              <label for="last_name">Apellido *</label>
            </div>

            <div class="input-field col s12 m6">
              <input id="email" type="email" class="validate" required>
              <label for="email">Correo Electrónico *</label>
            </div>
            <div class="input-field col s12 m6">
              <input id="phone" type="text" class="validate" required>
              <label for="phone">Teléfono de Contacto*</label>
            </div>
            <div class="input-field col s12 m6">
              <label for="country">Pais *</label>
              <select id="country" name="country" required>
                <option value="">Selecciona un país</option>
                <?php
                  foreach ($localizacion->paises() as $pais) {
                    echo '<option value="'.$pais["pais_nombre"].'">'.$pais["pais_nombre"].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="input-field col s12 m6">
              <input id="city" type="text" class="validate" required>
              <label for="city">Ciudad de Residencia *</label>
            </div>


            <div class="input-field col s12">
              <div class="input-field col s12 m6">
                <input type="checkbox" id="test5" value="Entre Pensamientos"/>
                <label for="test5" style="margin-left: -20px; padding-left: 30px; padding-top: 0;">Entre Pensamientos</label>
              </div>
              <div class="input-field col s12 m6">
                <input id="Cant_1" type="number" class="validate" required>
                <label for="Cant_1">Cantidad *</label>
              </div>
              <div class="input-field col s12 m6">
                <input type="checkbox" id="test5" value="Indeleble Poesía SEGMENTO I"/>
                <label for="test5" style="margin-left: -20px; padding-left: 30px; padding-top: 0;">Indeleble Poesía SEGMENTO I</label>
              </div>
              <div class="input-field col s12 m6">
                <input id="Cant_1" type="number" class="validate" required>
                <label for="Cant_1">Cantidad *</label>
              </div>
              <div class="input-field col s12 m6">
                <input type="checkbox" id="test5" value="Indeleble Poesía SEGMENTO II"/>
                <label for="test5" style="margin-left: -20px; padding-left: 30px; padding-top: 0;">Indeleble Poesía SEGMENTO II</label>
              </div>
              <div class="input-field col s12 m6">
                <input id="Cant_1" type="number" class="validate" required>
                <label for="Cant_1">Cantidad *</label>
              </div>
            </div>


            <div class="input-field col s12">
              <label for="message" class="active">Información Adicional *</label>
              <textarea id="message" class="text-field" required></textarea>
            </div>

            <div class="input-field col s12 right-align">
              <button class="waves-effect waves-light btn">Solicitar</button>
            </div>
          </form>



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
