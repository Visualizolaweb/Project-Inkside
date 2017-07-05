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
        <a href="#recordar" class="right blue-text darken-4" style="margin-top:10px;">Recuperar mi contraseña</a>
      </div>
      <a href="auth.php?p=facebook"><div class="col m2 social-icons"><i class="fa fa-facebook-official"> </i></div></a>
      <a href="auth.php?p=twitter"><div class="col m2 social-icons"><i class="fa fa-twitter"> </i></div></a>

      </div>
    </form>
  </div>
</div>
</section>

<!-- Modal Structure -->
<div id="recordar" class="modal">
  <div class="modal-content">
    <h5>Recupera tu cuenta</h5>
    <p>Ingresa tu correo electrónico para buscar tu cuenta.</p>
    <form action="quieromiclave" method="post">
      <div class="input-field col s6">
        <i class="fa fa-envelope-o input-icon right"></i>
        <input id="txt_password" type="email" name="email" required >
        <label for="txt_password">Correo electrónico</label>
      </div>

      <div class="input-field col s6">
        <button id="btnlogin" style="width:100%" class="waves-effect waves-light btn-large right" >Recordar contraseña</button>
      </div>
    </form>
  </div>
</div>
