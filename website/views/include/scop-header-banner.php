<?php if(!isset($dataFilter)) { ?>
  <div class="container wrap">
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
<?php } ?>
