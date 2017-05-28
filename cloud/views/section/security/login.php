<section id="pag_login">
<div class="row container">
  <div class="col m5 offset-m7 white border-1" id="wrap-login">
    <form id="frmlogin" class="row" method="post" data-parsley-validate style="margin-top:30px;">
      <h6>Ingresa con tu cuenta Inkside</h6>
      <div class="input-field col s12">
        <i class="fa fa-envelope input-icon right"></i>
        <input id="txt_email"  type="email" required>
        <label for="txt_email">Correo Electrónico</label>
      </div>

      <div class="input-field col s12">
        <i class="fa fa-unlock-alt input-icon right"></i>
        <input id="txt_password" type="password"  required >
        <label for="txt_password">Contraseña</label>
      </div>

      <div class="input-field col m12">
        <button id="btnlogin" style="width:100%" class="waves-effect waves-light btn-large right" ><i class="fa fa-sign-in"></i> Iniciar Sesión</button>
        <a href="view/contrasena_recuperar.php?correo=true" class="right blue-text darken-4" style="margin-top:10px;">Recuperar mi contraseña</a>
      </div>

      <div class="col m6 btn-register blue-grey white-text">
        <a href="registro">Registrar Cuenta</a>
      </div>

      <!-- <a href=""><div class="col m2 social-icons"><i class="fa fa-facebook-f"></i></div></a>
      <a href=""><div class="col m2 social-icons"><i class="fa fa-twitter"></i></div></a>
      <a href=""><div class="col m2 social-icons"><i class="fa fa-google-plus"></i></div></a> -->

    </form>
  </div>
</div>
</section>
