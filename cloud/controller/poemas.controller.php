<?php
// require_once 'model/poetas.model.php';

class PoemasController extends InitController{

  // private $poetas;
  //
  // public function __CONSTRUCT(){
  //     $this->poetas = new PoetasModel();
  // }

  public function detalle(){
      require_once 'views/include/structure-header-dashboard.php';
      require_once 'views/section/poems/detail.php';
      require_once 'views/include/structure-footer-dashboard.php';
  }

}
?>
