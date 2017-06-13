<?php
  require_once("controller/localizacion.controller.php");
  $localizacion = new localizacionController();

  require_once("controller/poetas.controller.php");
  $poeta = new PoetasController();

  if(!isset($_SESSION["poeta"]["poet_codigo"])){
     $codigoPoeta = $poeta->cargaCodigoPoeta();
     $_SESSION["poeta"]["poet_codigo"] = $codigoPoeta["poet_codigo"];
  }

  $poetaInfo = $poeta->buscarDatoPoeta();

?>

<section id="wrap-container">
<div class="row container-fluid">

  <div class="col m12 header-section">
    <h5 class="title">Actualiza tus información básica</h5>
  </div>


  <div class="col m9" id="wrap-login">

    <div class="row">
    <form  class="row" action="actualizar-perfil " method="post" data-parsley-validate id="perfilPoeta">
      <input type="hidden" name="data[8]" value="<?php echo $_SESSION["poeta"]["poet_codigo"];?>">


      <!-- <div class="input-field col s12">
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
      </div> -->

      <div class="input-field col s6">
        <input id="txt_nombre" name="data[1]" type="text" value="<?php echo $poetaInfo['poet_nombre'];?>" required autocomplete="off">
        <label for="txt_nombre">Nombre</label>
      </div>

      <div class="input-field col s6">
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

      <div class="input-field col s12" style="min-height: 50px;">
          <input name="data[6]" required type="radio" id="txt_hombre" value="Hombre" class="with-gap" <?php if($poetaInfo['poet_sexo'] == 'Hombre'){ echo 'checked="true"';} ?>/>
          <label for="txt_hombre" style="padding-left: 30px; padding-top: initial">Hombre</label>

          <input name="data[6]" required type="radio" id="txt_mujer" class="with-gap" value="Mujer" <?php if($poetaInfo['poet_sexo'] == 'Mujer'){ echo 'checked="true"';} ?>/>
          <label for="txt_mujer"  style="padding-left: 30px; padding-top: initial">Mujer</label>
      </div>


      <!-- <div class="input-field col s6">
        <input id="txt_descripcion" type="text" name="data[8]" required autocomplete="off">
        <label for="txt_descripcion">Descripcion</label>
      </div> -->

      <div class="input-field col m12" style="margin-bottom:20px; margin-top: 30px;">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >Actualizar Datos</button>
      </div>


    </form>
  </div>
  </div>
</div>
</section>
