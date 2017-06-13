<?php
 require_once 'model/seguidores.model.php';


class SeguidoresController extends InitController{

  private $seguidores;

  public function __CONSTRUCT(){
      $this->seguidores = new SeguidoresModel();
  }

  public function seguirPoeta(){
      $poet_codigo = $_POST["poet_codigo"];
      $micodigo    = $_POST["micodigo"];

      $seguidores = $this->seguidores->buscarSeguidores($micodigo);

      if(count($seguidores)<=0){
        $this->seguidores->seguir($poet_codigo, $micodigo);
      }else{
        $this->seguidores->actualizarSeguidores($poet_codigo, $micodigo);
      }
  }

}
?>