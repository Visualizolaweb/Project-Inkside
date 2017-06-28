<?php
 require_once 'website/model/buscador.model.php';

class BuscadorController{

  private $buscador;

  public function __CONSTRUCT(){
      $this->buscador = new BuscadorModel();
  }


  function buscarGlobal($filter){
    $result = $this->buscador->buscadorGlobal($filter);
    return $result;
  }


}
?>
