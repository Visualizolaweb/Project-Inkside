<?php
   require_once 'website/controller/publicaciones.controller.php';
   $publicaciones = new PublicacionesController();
?>
<div class="container">
  <div class="form-register right-align" style="position:relative;">
    <section>
      <h2>Regístrate</h2>
      <h3>Comienza a publicar tus escritos...</h3>
      <form id="registroPoeta" method="post">
        <div class="input-field col s12">
          <input class="fieldBD" id="txt_nombre" type="text"  name="data[1]" placeholder="Nombre" required>
        </div>
        <div class="input-field col s12">
          <input class="fieldBD" id="txt_apellido" type="text" name="data[2]"placeholder="Apellido" required>
        </div>
        <div class="input-field col s12">
          <input class="fieldBD" id="txt_email" type="email"  name="data[3]" placeholder="Correo Electrónico" required>
        </div>
        <div class="input-field col s12">
          <input class="fieldBD" id="txt_clave" type="password" name="data[5]" placeholder="Contraseña" required>
        </div>
        <span class="t require_once 'model/publicaciones.model.php';erms">Al hacer clic en <b>regístrate</b> acepto todos los <b>Términos legales</b> al igual que las <b>Politicas de privacidad</b></span>
        <button class="waves-effect waves-light btn primary-button z-depth-0 btn-icon"><i class="fa fa-user icon-button"></i> Registrate en Inkside</button>
      </form>
    </section>
  </div>
</div>
<div class="background-mobile"></div>
<div class="slider hide-on-small-only">
   <ul class="slides">
     <li>
       <img src="inkside-slider-3">
       <div class="caption left-align ">
         <h3>COMPARTE, LEE Y CREA</h3>
         <h5 class="light grey-text text-lighten-3">En la mas grande comunidad de poesia de internet</h5>
       </div>
     </li>
     <li>
       <img src="inkside-slider-2">
       <div class="caption left-align">
         <h3>"La mujer que lee</h3>
         <h5 class="light grey-text text-lighten-3">almacena su belleza para la vejez."</h5>
         <span>- Frida Khalo.</span>
       </div>
     </li>
     <li>
       <img src="inkside-slider-4">
       <div class="caption left-align">
         <h3>"Me enamoré de la vida</h3>
         <h5 class="light grey-text text-lighten-3">es la única que no me dejará sin antes yo hacerlo."</h5>
         <span>-    Pablo Neruda.</span>
       </div>
     </li>
   </ul>
 </div>

 <section class="sec-publicaciones secundary-default">
   <div class="container">
       <h1>Publicaciones de la comunidad</h1>
       <h6>Alguien en la comunidad ha escrito</h6>

       <div class="row">
         <?php
                $poemas = $publicaciones->poemas();
                foreach ($poemas as $row) {
                  $contenido = $publicaciones->getSubString($row['pub_contenido']);
                  echo '<div class="col s12 m6 l4 panel">
                    <div class="white">
                      <h2>'.$row['pub_titulo'].'</h2>
                      <span class="date">Publicado el '.$row['pub_fechaPublicacion'].'</span>
                      <article>
                      '.$contenido.'
                      <div class="more"><a href="pubID'.$row['pub_codigo'].'" class="read-more">Seguir Leyendo</a></div>
                      </article>
                      <div class="bypoeta">
                          <img src="cloud/'.$row['poet_foto'].'" class="circle"/>
                          <h3>'.$row['poet_nick'].'</h3>
                      </div>
                    </div>
                  </div>';
                }
         ?>
       </div>
   </div>
</section>

<section class="sec-wrap-news primary-default">
  <div class="container">
    <h2>Artículos, Noticias y Eventos</h2>
    <p>Lo último de la actividad literaria y poética en el mundo</p>
    <div class="row">
      <div class="col l3">
        <article>
          <div class="title label-event">Evento</div>
          <div class="cover"><img src="app/view/assets/images/events/cover.jpg" class="responsive-img"></div>
          <div class="content white">
            <h4>Festival de Poesía</h4>
            <p>Marzipan cotton candy chocolate bonbon caramels sweet roll liquorice marshmallow. Chupa chups carrot cake brownie... </p>
            <div class="detail"><a href="poema-del-moribundo-que-no-tiene-quien-le-escriba">Ver Mas</a></div>
          </div>
        </article>
      </div>
      <div class="col l3">
        <article>
          <div class="title label-news">Evento</div>
          <div class="cover"><img src="app/view/assets/images/events/cover.jpg" class="responsive-img"></div>
          <div class="content white">
            <h4>Festival de Poesía</h4>
            <p>Marzipan cotton candy chocolate bonbon caramels sweet roll liquorice marshmallow. Chupa chups carrot cake brownie... </p>
            <div class="detail"><a href="poema-del-moribundo-que-no-tiene-quien-le-escriba">Ver Mas</a></div>
          </div>
        </article>
      </div>
      <div class="col l3">
        <article>
          <div class="title label-article">Evento</div>
          <div class="cover"><img src="app/view/assets/images/events/cover.jpg" class="responsive-img"></div>
          <div class="content white">
            <h4>Festival de Poesía</h4>
            <p>Marzipan cotton candy chocolate bonbon caramels sweet roll liquorice marshmallow. Chupa chups carrot cake brownie... </p>
            <div class="detail"><a href="poema-del-moribundo-que-no-tiene-quien-le-escriba">Ver Mas</a></div>
          </div>
        </article>
      </div>
      <div class="col l3">
        <article>
          <div class="title label-event">Evento</div>
          <div class="cover"><img src="app/view/assets/images/events/cover.jpg" class="responsive-img"></div>
          <div class="content white">
            <h4>Festival de Poesía</h4>
            <p>Marzipan cotton candy chocolate bonbon caramels sweet roll liquorice marshmallow. Chupa chups carrot cake brownie... </p>
            <div class="detail"><a href="poema-del-moribundo-que-no-tiene-quien-le-escriba">Ver Mas</a></div>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>
