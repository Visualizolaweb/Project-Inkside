<?php
  if(!isset($_SESSION["poeta"])){
    header("Location: ./");
  }else{
      $rol_codigo = $_SESSION["poeta"]["rol_codigo"];
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Dashboard InkSide</title>
    <link type="text/css" rel="stylesheet" href="views/assets/materialize/css/materialize.min.css"/>
    <link type="text/css" rel="stylesheet" href="views/assets/font-icons/css/font-awesome.css"/>
    <link type="text/css" rel="stylesheet" href="views/assets/js/sweetmodal/min/jquery.sweet-modal.min.css" />
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,900|Roboto|Roboto+Condensed:400,700"/>
    <link type="text/css" rel="stylesheet" href="views/assets/css/main-dashboard.css"/>
    <link type="text/css" rel="stylesheet" href="views/assets/css/jquery-te-1.4.0.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <div class="fixed-sidebar ">
      <div class="fixed-sidebar-left">
        <div class="logo-inkside primary-default">
          <a href="#!" class="brand-logo"><img src="views/assets/images/Logo-Inkside@150.png" alt="InkSide" class="responsive-img"></a>
        </div>
        <div class=" ">
          <?php include("views/include/scop-navigation.php"); ?>
        </div>
      </div>
    </div>
    <header>
      <div class="container-fluid">
        <div class="row" style="padding: 0 25px;">
          <div class="col l8">
            <div class="search">
              <form>
                <label>Buscar</label>
                <input id="busqueda" onKeyUp="buscar();" name="busqueda" type="text"/>
                <a href="" class="white-text"><i class="fa fa-search"></i></a>
              </form>
              <div id="resultadoBusqueda"></div>
            </div>
          </div>
          <div class="col l4  right-align">
            <a class="dropdown-button" href="#!" data-activates="menuPoet">
              <div class="profile">
                <span class="title"><?php echo $_SESSION["poeta"]["poet_nick"]; ?></span>
                <img src="<?php echo $_SESSION["poeta"]["poet_foto"] ?>" alt="" class="circle">
                <i class="fa fa-caret-down "></i>
              </div>
            </a>

            <ul id="menuPoet" class="dropdown-content" >
               <?php include("views/include/scop-navigation-poet.php"); ?>
            </ul>
          </div>
        </div>
      </div>
    </header>
