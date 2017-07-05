<?php

  require_once("controller/categorias.controller.php");
  require_once("controller/poetas.controller.php");

  $poetas = new PoetasController();
  $categorias = new categoriasController();


  if(isset($_SESSION["poeta"]["poet_codigo"])){
  $codigoPoeta = $_SESSION["poeta"]["poet_codigo"];
}else{
  header("Location: ../");
}


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Completa tu perfil</title>
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
      <h1 class="center-align">Tu cuenta se ha activado correctamente.</h1>
      <p class="center-align">Ya casi terminamos, completa tu perfil en Inkside para lograr una mejor experiencia dentro de la comunidad.</p>
      <div class="row white content-profile">
        <div id="panel-profile" class="col l4 center-align blue-grey lighten-4">
          <div id="wrap-result"><img src="views/assets/images/perfil/img_default.png"></div>
          <a  href="#uploadImage" class="upload-button">Editar Foto</a>
          <p>La foto de perfil la puedes editar más adelante, si no subes una imagen JPG o PNG la imagen por defecto será la que se está mostrando actualmente.</p>
        </div>
        <div class="col l8">
          <form action="guardoPerfil" method="post">
            <div class="input-field col l6">
              <input id="poetCodigo" type="hidden" name="data[0]" value="<?php echo $codigoPoeta ?>">
              <input id="txt_nombre_corto" name="data[1]" type="text" required autocomplete="off">
              <label for="txt_nombre_corto">Seudónimo</label>
            </div>

            <div class="input-field col l6" id="categorias" style="height: 55px;">
              <?php $categorias->cargarCategoriasProfile(); ?>
            </div>

            <div class="input-field col l12" >
              <textarea rows="20" name="data[3]" id="txt_contenido"></textarea>
            </div>

            <div class="input-field col l12" style="margin-bottom: 20px" >
              <button type="button" onclick="guardar_datos()" class="waves-effect waves-light btn">Guardar datos</button>
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
      $('select').material_select();
      $("#txt_contenido").jqte({
        placeholder: "Cuéntanos algo de sobre ti."
      });


       $('#uploadImage').modal({
          dismissible: true,
          opacity: .8,
          startingTop: '5%',
          endingTop: '5%'
       });

       $uploadCrop = $('#wrap-upload').croppie({
           enableExif: true,
           viewport: {
               width: 180,
               height: 180
           },
           boundary: {
               width: 240,
               height: 240
           }
       });

       $('#upload').on('change', function () {
         var reader = new FileReader();
           reader.onload = function (e) {
             $uploadCrop.croppie('bind', {
               url: e.target.result
             }).then(function(){
               console.log('jQuery bind complete');
             });

           }
           reader.readAsDataURL(this.files[0]);
       });

       $('.upload-result').on('click', function (ev) {

         var file = $("#upload").val();

         if(file != ""){
         $uploadCrop.croppie('result', {
           type: 'canvas',
           size: 'viewport'
         }).then(function (resp) {

           $.ajax({
             url: "index.php?c=poetas&a=updateAvatar",
             type: "POST",
             data: {"image":resp, "code":$("#poetCodigo").val()},
             success: function (data) {
               html = '<img src="' + resp + '" />';
               $('.modal').modal('close');
               $("#wrap-result").html(html);
               $("header .profile img").attr("src",resp);
             }
           });
         });

          }
       });

       function guardar_datos(){

          if(($("txt_nombre_corto").val() != "") && ($(".select-dropdown").val() != 'Categorias que te gustan')){
              $("form").submit();
          }else{
            alert("Los campos 'Nombre a mostrar' y 'Categoria' son obligatorios");
          }


       }
    </script>
    </body>
  </html>
