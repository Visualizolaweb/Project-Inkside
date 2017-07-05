<?php if(!isset($dataFilter)) { ?>
  <div class="container wrap">
  <div class="form-register right-align" style="position:relative;">
    <section>
      <h2>Regístrate</h2>
      <h3>Comienza a publicar tus escritos...</h3>
      <form id="registroPoeta" method="post">
        <div class="input-field col s12">
          <input autocomplete="off"  class="fieldBD" id="txt_nombre" type="text"  name="data[1]" placeholder="Nombre" required>
        </div>
        <div class="input-field col s12">
          <input autocomplete="off"  class="fieldBD" id="txt_apellido" type="text" name="data[2]"placeholder="Apellido" required>
        </div>
        <div class="input-field col s12" id="wrapTxtEmail">
          <input autocomplete="off"  class="fieldBD" id="txt_email" type="email"  name="data[3]" placeholder="Correo Electrónico" required>
        </div>
        <div class="input-field col s12">
          <input autocomplete="off"  class="fieldBD" id="txt_clave" type="password" name="data[5]" placeholder="Contraseña" required>
        </div>
        <span class="terms">Al hacer clic en <b>regístrate</b> acepto todos los <b>Términos legales</b> al igual que las <b>Politicas de privacidad</b></span>

        <button id="signup" class="waves-effect waves-light btn primary-button z-depth-0 btn-icon"><i class="fa fa-user icon-button"></i> Registrate en Inkside</button>
        <a href="cloud/auth.php?p=facebook" style="margin-right:5px" class="btn-social waves-effect waves-light btn indigo darken-4 z-depth-0 btn-icon"><i class="fa fa-facebook icon-button  indigo darken-4"></i> Facebook</a>
        <a href="cloud/auth.php?p=twitter"  class="btn-social waves-effect waves-light btn light-blue  lighten-1 z-depth-0 btn-icon"><i class="fa fa-twitter  icon-button light-blue lighten-1"></i> Twitter </a>

      </form>
    </section>
  </div>
</div>
<div class="background-mobile"></div>
<div class="slider hide-on-small-only">
   <ul class="slides">
     <li>
       <img src="website/views/assets/images/slider/segmento.png">

     </li>
     <li>
       <img src="inkside-slider-3">
       <div class="caption left-align ">
         <h3>Comparte tus poemas escritos</h3>
         <h5 class="light grey-text text-lighten-3">En la primera comunidad de amantes de la poesía</h5>
       </div>
     </li>
     <li>
       <img src="inkside-slider-2">
       <div class="caption left-align">
         <h3>Comenta los escritos y poemas</h3>
         <h5 class="light grey-text text-lighten-3">de los demás en la comunidad para hacer que <br>Inkside Poesía siga creciendo</h5>
       </div>
     </li>
     </li>

     <li>
       <img src="inkside-slider-4">
       <div class="caption left-align">
         <h3>Lee y dedica poemas  </h3>
         <h5 class="light grey-text text-lighten-3">a quien desees para que  la poesía siga creciendo</h5>
        </div>
     </li>
   </ul>
 </div>
<?php } ?>
