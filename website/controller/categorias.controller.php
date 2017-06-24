<?php
 require_once 'website/model/categorias.model.php';

class CategoriasController{

  private $categorias;

  public function __CONSTRUCT(){
      $this->categorias = new CategoriasModel();
  }

  public function categoriabyId($categorias){
    $result = $this->categorias->buscarCategoria($categorias); 
    return $result;

  }


}
?>
