<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Dashboard InkSide</title>
    <link type="text/css" rel="stylesheet" href="views/assets/materialize/css/materialize.min.css"/>
    <link type="text/css" rel="stylesheet" href="views/assets/font-icons/css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="views/assets/js/sweetmodal/min/jquery.sweet-modal.min.css" />
    <link type="text/css" rel="stylesheet" href="views/assets/css/main-dashboard.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <div class="fixed-sidebar ">
      <div class="fixed-sidebar-left">
        <div class="logo-inkside primary-default">
          <a href="#!" class="brand-logo"><img src="views/assets/images/Logo-Inkside@150.png" alt="InkSide" class="responsive-img"></a>
        </div>
      </div>
    </div>
    <header>
      <div class="container-fluid">
        <div class="row ">
          <div class="col 14 offset-l8 right">
            <div class="profile">
              <a class="dropdown-button" href="#!" data-activates="menuPoet">
                <span class="title">Guillermo León </span>
                <img src="views/assets/images/perfil/img_default@50.png" alt="" class="circle">
                <i class="fa fa-caret-down "></i>
              </a>
            </div>


            <ul id="menuPoet" class="dropdown-content">
               <?php include("views/include/scop-navigation-poet.php"); ?>
            </ul>
          </div>
        </div>
      </div>
    </header>
