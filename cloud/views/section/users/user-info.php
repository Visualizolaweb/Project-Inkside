<?php
  require_once("controller/localizacion.controller.php");
  $localizacion = new localizacionController();

  require_once("controller/poetas.controller.php");
  $poeta = new PoetasController();

  $poetaInfo = $poeta->buscarDatoPoeta();

?>

<section id="wrap-container">
<div class="row container-fluid">

  <div class="col m12 " id="wrap-login">
    <h5>Perfil de Poeta</h5>
    <form class="row" action="actualizar-perfil " method="post" data-parsley-validate id="perfilPoeta">
      <input type="hidden" name="data[8]" value="<?php echo $_SESSION["poeta"]["poet_codigo"];?>">
      <h6>Ingresa tus datos</h6>

      <div class="input-field col s12">
        <?php $localizacion->cargarPaises(); ?>
      </div>

      <div class="input-field col s12">
        <select id='txt-departamento' class='browser-default validate' disabled require>
          <option value=''>Seleccione un Departamento</option>
        </select>
      </div>

      <div class="input-field col s12">
        <select id='txt-ciudad' name="data[0]" class='browser-default validate' disabled require>
          <option value=''>Seleccione una Ciudad</option>
        </select>
      </div>

      <div class="input-field col s12">
        <input id="txt_nombre" name="data[1]" type="text" value="<?php echo $poetaInfo['poet_nombre'];?>" required autocomplete="off">
        <label for="txt_nombre">Nombre</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_apellido" name="data[2]" value="<?php echo $poetaInfo['poet_apellido'];?>"  type="text" required autocomplete="off">
        <label for="txt_apellido">Apellido</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_nombre_corto" name="data[3]"  value="<?php echo $poetaInfo['poet_nick'];?>" type="text" required autocomplete="off">
        <label for="txt_nombre_corto">Nombre Corto</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_email" name="data[4]" value="<?php echo $poetaInfo['poet_email'];?>" type="email" required autocomplete="off">
        <label for="txt_email">Tu dirección de correo electrónico</label>
      </div>

      <div class="input-field col s12">
        <input id="txt_fecha_nacimiento"  value="<?php echo $poetaInfo['poet_fecha_nac'];?>" class="datepicker" type="text" name="data[5]" required autocomplete="off">
        <label for="txt_fecha_nacimiento">Fecha de nacimiento</label>
      </div>

      <div class="input-field col s12">
        <?php
          if ($poetaInfo['poet_sexo']=='Hombre') {
        ?>
            <p>
              <input name="data[6]" type="radio" id="txt_hombre" value="Hombre" checked="true"/>
              <label for="txt_hombre">Hombre</label>
            </p>
            <p>
              <input name="data[6]" type="radio" id="txt_mujer" value="Mujer"/>
              <label for="txt_mujer">Mujer</label>
            </p>
        <?php
      }elseif ($poetaInfo['poet_sexo']=='Mujer') {
        ?>
            <p>
              <input name="data[6]" type="radio" id="txt_hombre" value="Hombre"/>
              <label for="txt_hombre">Hombre</label>
            </p>
            <p>
              <input name="data[6]" type="radio" id="txt_mujer" value="Mujer" checked="true"/>
              <label for="txt_mujer">Mujer</label>
            </p>
        <?php
      }else{
        ?>
            <p>
              <input name="data[6]" type="radio" id="txt_hombre" value="Hombre"/>
              <label for="txt_hombre">Hombre</label>
            </p>
            <p>
              <input name="data[6]" type="radio" id="txt_mujer" value="Mujer"/>
              <label for="txt_mujer">Mujer</label>
            </p>
        <?php
      }
        ?>

      </div>

      <div class="input-field col s12">
        <input id="txt_celular" type="text" name="data[7]" value="<?php echo $poetaInfo['poet_celular'];?>" required autocomplete="off">
        <label for="txt_celular">Celular</label>
      </div>

      <!-- <div class="input-field col s6">
        <input id="txt_descripcion" type="text" name="data[8]" required autocomplete="off">
        <label for="txt_descripcion">Descripcion</label>
      </div> -->

      <div class="input-field col m12" style="margin-bottom:20px">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >Actualizar</button>
      </div>


    </form>
  </div>
</div>
</section>
