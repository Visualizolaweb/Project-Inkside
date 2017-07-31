<?php
   require_once 'website/controller/publicaciones.controller.php';
   $publicaciones = new PublicacionesController();
?>
<section class="sec-publicaciones secundary-default">
  <div class="container wrap">
    <h1>Reportar un abuso!</h1>
    <div class="row">
      <div class="col l12">
        <p>Te pedimos por favor que nos cuentes explicitamente si tu o alguién que conoces de la comunidad Inkside Poesía ha sido victima de una situación abusiva, por favor llena el siguiente formulario en el caso que:
          <ul class="item-abuso">
            <li>Quieras denunciar el perfil de un impostor.</li>
            <li>Alguién haya robado tu cuenta o la de un amigo y está haciendo uso indebido de ella.</li>
            <li>Desde tu cuenta o la de un amigo están enviado mensajes o correos que nunca has creado.</li>
            <li>Hayas recibido un mensaje de correo electrónico sobre la creación de una cuenta en Inkside Poesía, pero ya estés registrado(a).</li>
            <li>Alguién esté escribiendo artículos o comentarios que atentan contra ti u otras personas.</li>
            <li>Hayas encontrado contenido pornográfico-ilegal, racista,  xenófobo, discriminatorio o de otro tipo que afecte la sana convivencia de la comunidad InkSide.</li>
            <li>Alguién esté atentando contra tus valores, integridad, buen nombre o hasta tu propia vida, haciendo uso del sitio Web como vía de comunicación para dichos fines.</li>
            <li>U otro tipo de manifestación abusiva en tu contra.</li>
          </ul>

          <b>Los campos marcados con * son requeridos.</b>
        </p>

        <form class="row" action="reportar-abuso" method="post">
          <div class="input-field col s12 m5">
            <input id="last_name" type="text" class="validate" required>
            <label for="last_name">Nombre Completo *</label>
          </div>

          <div class="input-field col s12 m5">
            <input id="email" type="email" class="validate" required>
            <label for="email">Correo Electrónico *</label>
          </div>

          <div class="input-field col s12 m5">
            <select class="browser-default select-field" required>
              <option value="" disabled selected>¿El abuso es de un autor?</option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
          </div>

          <div class="input-field col s12 m5">
            <input id="nombre" type="text" class="validate">
            <label for="nombre">Nombre del autor del abuso</label>
          </div>

          <div class="input-field col s12">
            <label for="message" class="active">Por favor describa el abuso *</label>
            <textarea id="message" class="text-field" required></textarea>
          </div>

          <div class="input-field col s10 right-align">
            <input type="checkbox" id="test5" required />
            <label for="test5" style="padding-left:25px;"> Acepto los términos de uso </label>
          </div>

          <div class="input-field col s2 right-align">
            <button class="waves-effect waves-light btn">Enviar</button>
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
