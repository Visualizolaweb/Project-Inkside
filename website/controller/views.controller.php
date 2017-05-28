<?php
require_once 'website/model/poetas.model.php';

class ViewsController{

  private $poetas;

  public function __CONSTRUCT(){
      $this->poetas = new PoetasModel();
  }

  public function index(){

    $poetas = $this->poetas->ultimosPoetas();
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/index/index.php';
    include_once 'website/views/include/scop-community.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function poemas(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/poemas/index.php';
    require_once 'website/views/include/structure-footer.php';
  }

  public function comunidad(){
    require_once 'website/views/include/structure-header.php';
    require_once 'website/views/section/comunidad/index.php';
    require_once 'website/views/include/structure-footer.php';
  }


    public function todosPoemas(){
      require_once 'website/views/include/structure-header.php';
      require_once 'website/views/section/poemas/poemas.php';
      require_once 'website/views/include/structure-footer.php';
    }
}
?>
