<nav class="primary-default">
  <div class="container">
    <div class="row">
      <div class="col s12 m6 l3">
        <a href="#!" class="brand-logo"><img src="website/views/assets/images/Logo-Inkside.png" alt="InkSide" class="responsive-img"></a>
        <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="fa fa-bars"></i></a>
      </div>

      <div class="col l2 hide-on-med-and-down">
        <ul class="center ">
          <li class="active-drop"><a class="dropdown-button " href="#!" data-activates="menuinkside">Explorar <i class="fa fa-caret-down"> </i></a></li>
         </ul>

         <ul id="menuinkside" class="dropdown-content">
            <?php include("website/views/include/scop-navigation-list.php"); ?>
         </ul>
      </div>

      <div class="col hide-on-small-only m6 l4  ">
        <form>
          <div class="row">
            <div class="input-field col s10">
              <i class="fa fa-search icon-search"></i>
              <input type="text" name="txt-search" id="txt-search" placeholder="Buscar en el sitio" class="validate">
            </div>
          </div>
        </form>
      </div>

      <div class="col l3 hide-on-med-and-down" style="text-align:right;">
         <a href="cloud/" class="waves-effect waves-light btn primary-button z-depth-0 btn-icon"><i class="fa fa-user icon-button"></i> Iniciar Sesión</a>
      </div>

      <ul class="side-nav blue-grey darken-4" id="mobile-menu">
         <li><h2>EXPLORAR</h2></li>
         <?php include("website/views/include/scop-navigation-list-mobile.php"); ?>
      </ul>
    </div>
  </div>
</nav>
