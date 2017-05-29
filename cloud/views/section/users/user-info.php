<section id="pag_login">
<div class="row container">

  <div class="col m12 " id="wrap-login">
    <h5>Perfil de Poeta</h5>
    <form class="row" method="post" data-parsley-validate id="perfilPoeta">
      <h6>Ingresa tus datos</h6>

      <div class="input-field col s12">
        <input id="txt_ciudad" name="data[0]" type="text" required autocomplete="off">
        <label for="txt_ciudad">Ciudad</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_nombre" name="data[1]" type="text" required autocomplete="off">
        <label for="txt_nombre">Nombre</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_apellido" name="data[2]"  type="text" required autocomplete="off">
        <label for="txt_apellido">Apellido</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_nombre_corto" name="data[3]"  type="text" required autocomplete="off">
        <label for="txt_nombre_corto">Nombre Corto</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_email" name="data[4]" type="email" required autocomplete="off">
        <label for="txt_email">Tu dirección de correo electrónico</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_foto" name="data[5]" type="file" required autocomplete="off" data-parsley-minlength="8">
        <label for="txt_foto">Tu Foto</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_fecha_nacimiento" class="datepicker" type="text" name="data[6]" required autocomplete="off">
        <label for="txt_fecha_nacimiento">Fecha de nacimiento</label>
      </div>

      <div class="input-field col s12">
        <input type="radio" name="data[7]" id="hombre">
				<label for="txt_hombre">Hombre</label>
				<input type="radio" name="data[7]" id="mujer">
				<label for="txt_mujer">Mujer</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_celular" type="text" name="data[8]" required autocomplete="off">
        <label for="txt_celular">Celular</label>
      </div>

      <div class="input-field col s6">
        <input id="txt_descripcion" type="text" name="data[9]" required autocomplete="off">
        <label for="txt_descripcion">Descripcion</label>
      </div>

      <div class="input-field col m12" style="margin-bottom:20px">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >Actualizar</button>
      </div>


    </form>
  </div>
</div>
</section>
