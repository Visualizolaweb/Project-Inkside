<?php

if(isset($_GET["pid"])){
    $poet_codigo = base64_decode($_GET["pid"]);
}else{
  header("Location: ../");
}


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Cambia tu contraseña</title>
    <link type="text/css" rel="stylesheet" href="views/assets/materialize/css/materialize.min.css"/>
    <link type="text/css" rel="stylesheet" href="views/assets/font-icons/css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="views/assets/js/sweetmodal/min/jquery.sweet-modal.min.css" />
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,900|Roboto|Roboto+Condensed:400,700"/>
    <link type="text/css" rel="stylesheet" href="views/assets/css/main-dashboard.css"/>
    <link type="text/css" rel="stylesheet" href="views/assets/css/croppie.css"/>
    <link type="text/css" rel="stylesheet" href="views/assets/css/jquery-te-1.4.0.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
      .select-wrapper input.select-dropdown{
        border: 1px solid #d6d6d6;
        color:#9e9e9e;
      }

      .dropdown-content{
        right: -5px;
        top: 45px !important;
      }

      #complete-profile h1{
        font-size: 35px;
        margin-bottom: 0;
      }

      #panel-profile{
        padding: 20px 0;
        justify-content: center;
        align-items: center;
        height: 462px;
      }

      #panel-profile a{
        display: block;
        margin-top: 20px;
        border: 2px solid #fff;
        position: relative;
        width: 200px;
        padding: 10px;
        margin-left: auto;
        margin-right: auto;
        color: white;
      }

      #panel-profile p{
        color: white;
        margin: 10px auto;
        font-size: 12px;
        width: 90%;
        position: relative;
      }

      .jqte{
        margin-top: 0;
      }

      #complete-profile form{
        padding: 10px;
      }

      .jqte_placeholder {
          display:block;
      }
    </style>
  </head>
  <body>

    <div id="complete-profile" class="container">
      <h1 class="center-align">Cambia tu contraseña.</h1>
      <p class="center-align">Ingresa una contraseña que sea facil para ti, pero complicada para los demas.</p>
      <div class="row  content-profile">
         <div class="col l8 white offset-l2">
          <form action="cambioClave" method="post" data-parsley-validate>


            <div class="input-field col s6">
              <input id="poetCodigo" type="hidden" name="data[0]" value="<?php echo $poet_codigo ?>">
              <i class="fa fa-lock input-icon right"></i>
              <input id="txt_password" name="data[1]" type="password" required autocomplete="off" data-parsley-minlength="8">
              <label for="txt_password">Cree una contraseña</label>
            </div>

            <div class="input-field col s6">
              <i class="fa fa-lock input-icon right"></i>
              <input id="txt_clave_confirm" type="password" required data-parsley-equalto="#txt_password" autocomplete="off">
              <label for="txt_clave_confirm">Confirma tu contraseña</label>
            </div>

            <div class="input-field col l12 right-align" style="margin-bottom: 20px" >
              <button  class="waves-effect waves-light btn">Guardar datos</button>
            </div>
          </form>


        </div>

      </div>
    </div>

    <div id="uploadImage" class="modal">
      <div class="modal-content">
        <div class="row">
          <div class="col l6">
            <div id="wrap-upload" style="width:350px"></div>
          </div>
          <div class="col l6 center-align">
                <input type="file" id="upload"><br><br>
                <button class="btn btn-success upload-result">Recortar Imagen</button>
          </div>

        </div>
      </div>
    </div>
    <script type="text/javascript" src="views/assets/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="views/assets/materialize/js/materialize.min.js"></script>
    <script type="text/javascript" src="views/assets/js/parsley/dist/parsley.min.js"></script>
    <script type="text/javascript" src="views/assets/js/parsley/dist/i18n/es.js"></script>
    <script type="text/javascript" src="views/assets/js/sweetmodal/min/jquery.sweet-modal.min.js"></script>
    <script type="text/javascript" src="views/assets/js/jquery-te-1.4.0.min.js"></script>
    <script type="text/javascript" src="views/assets/js/croppie.js"></script>
    <script>
    var ctrlDown = false, ctrlKey = 17, cmdKey = 91, vKey = 86, cKey = 67;
    $(document).keydown(function(e) {
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
        }).keyup(function(e) {
        if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = false;
    });

    $("#txt_password").keydown(function(e) {
        if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey)) return false;
    });

    $("#txt_clave_confirm").keydown(function(e) {
        if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey)) return false;
    });

    </script>
    </body>
  </html>
