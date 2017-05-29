<?php

class ViewsController{

  public function index(){
    require_once 'views/include/structure-header.php';
    require_once 'views/section/security/login.php';
    require_once 'views/include/structure-footer.php';
  }

  public function registro(){
    require_once 'views/include/structure-header.php';
    require_once 'views/section/security/register.php';
    require_once 'views/include/structure-footer.php';
  }

  public function completaPerfil(){
    echo "perfil";
  }

  public function actualizarPerfil(){
    require_once 'views/include/structure-header.php';
    require_once 'views/section/users/user-info.php';
    require_once 'views/include/structure-footer.php';
  }

  public function dashboard(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

}


?>
