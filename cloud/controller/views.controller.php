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
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/users/user-info.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function mensajes(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/messages/inbox.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function crearMensaje(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/messages/create.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function responder(){
    $pid = $_GET['pid'];
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/messages/answer.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function dashboard(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/dashboard/main.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function poemas(){
    $tipoArticulo = $_GET["t"];
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/poems/main.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function misPublicaciones(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/publications/mypublish.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }


  public function crearPoema(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/poems/create_poem.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function editaPoema(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/poems/update_poem.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function actualizarPoema(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/poems/edit_poem.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function crearPublicacion(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/publications/create_publication.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function crearEventos(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/events/create_evento.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function busqueda(){
    require_once 'views/include/structure-header-dashboard.php';
    require_once 'views/section/search/result-search.php';
    require_once 'views/include/structure-footer-dashboard.php';
  }

  public function completoPerfil(){
    require_once 'views/section/users/complete-profile.php'; 
  }

}


?>
