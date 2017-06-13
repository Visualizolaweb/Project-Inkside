<?php
require "model/comentarios.model.php";

class ComentariosController{

  private $comentarios;

  public function __CONSTRUCT(){
      $this->comentarios = new ComentariosModel();
  }

  public function comentarios($pub_codigo){
      $result = $this->comentarios->comentariosByPublicacion($pub_codigo);
      return $result;
  }
}

?>
