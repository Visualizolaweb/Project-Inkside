<?php
   require_once 'website/controller/publicaciones.controller.php';
   $publicaciones = new PublicacionesController();
?>
<section class="sec-publicaciones secundary-default">
  <div class="container wrap">
    <h1>Agradecemos que participes escribiendo tus sugerencias!</h1>
    <div class="row">
      <div class="col l12">
        <p>Si tienes alguna sugerencia, inquietud, queja o simplemente quieres contarnos tus experiencias en InkSide Poesía... <br>
Has llegado al lugar indicado!, envianos tu mensaje a través del siguiente formulario. En Inkside Poesía estamos siempre atentos para ti.</p>
        <b>Los campos marcados con * son obligatorios.</b>

        <form class="row" action="ayudanos-a-mejorar" method="post">
          <div class="input-field col s12 m4">
            <input id="last_name" type="text" class="validate" required>
            <label for="last_name">Nombre Completo *</label>
          </div>

          <div class="input-field col s12 m4">
            <input id="email" type="email" class="validate" required>
            <label for="email">Correo Electrónico *</label>
          </div>

          <div class="input-field col s8">
            <input id="last_name" type="text" class="validate">
            <label for="last_name">Asunto *</label>
          </div>

          <div class="input-field col s12">
            <label for="message" class="active">Mensaje *</label>
            <textarea id="message" class="text-field" required></textarea>
          </div>

          <div class="input-field col s12 right-align">
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
