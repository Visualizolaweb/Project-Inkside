<nav class="primary-default">
  <div class="container">
    <div class="row">
      <div class="col m3">
        <a href="#!" class="brand-logo"><img src="views/assets/images/Logo-Inkside.png" alt="InkSide" class="responsive-img"></a>
        <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="fa fa-bars"></i></a>
      </div>

      <div class="col m2 hide-on-med-and-down">
        <ul class="center ">
          <li class="active-drop"><a class="dropdown-button " href="#!" data-activates="menuinkside">Explorar <i class="fa fa-caret-down"> </i></a></li>
         </ul>

         <ul id="menuinkside" class="dropdown-content">
            <?php include("views/include/scop-navigation-list.php"); ?>
         </ul>
      </div>

      <div class="col m4 hide-on-med-and-down">
        <form>
          <div class="row">
            <div class="input-field col s10">
              <i class="fa fa-search icon-search"></i>
              <input type="text" name="txt-search" id="txt-search" placeholder="Buscar en el sitio" class="validate">
            </div>
          </div>
        </form>
      </div>

      <div class="col m3 hide-on-med-and-down" style="text-align:right;">
         <?php if(isset($_SESSION["poeta"]["poet_codigo"])){ ?>
           <ul>
             <li class="active-drop data-poet" style=" text-align:left;">
               <a class="dropdown-button " href="#!" data-activates="menuPoet">
                 <?php if ($_SESSION["poeta"]["acc_origen_conexion"] == "inkside") { ?>
                    <img src="views/assets/images/perfil/<?php echo $_SESSION["poeta"]["poet_foto"]?>" class="circle"/>
                 <?php } else { ?>
                    <img src="<?php echo $_SESSION["poeta"]["poet_foto"]?>"  class="circle"/>
                 <?php } ?>
                <?php echo $_SESSION["poeta"]["poet_nombre"]; ?> <i class="fa fa-caret-down"></i>
               </a>
             </li>
            </ul>
         <?php }else{ ?>
             <a href="./" class="waves-effect waves-light btn primary-button z-depth-0 btn-icon"><i class="fa fa-user icon-button"></i> Iniciar Sesión</a>
         <?php } ?>
      </div>
      <ul id="menuPoet" class="dropdown-content">
         <?php include("views/include/scop-navigation-poet.php"); ?>
      </ul>
      <ul class="side-nav blue-grey darken-4" id="mobile-menu">
         <li><h2>EXPLORAR</h2></li>
         <?php include("views/include/scop-navigation-list.php"); ?>
      </ul>
    </div>
  </div>
</nav>
