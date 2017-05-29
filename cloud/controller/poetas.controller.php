<?php
require_once 'model/poetas.model.php';

class PoetasController extends InitController{

  private $poetas;

  public function __CONSTRUCT(){
      $this->poetas = new PoetasModel();
  }

  public function actualizarDatoPoeta(){
     $data = $_POST["data"];
     $result = $this->poetas->actualizarPoeta($data);
  }

}
?>
