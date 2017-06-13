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

  public function crearComentario(){
      $data = $_POST["data"];
      $result = $this->comentarios->guardarComentario($data);

      header("Location: index.php?c=poemas&a=detalle&pid=".$data[1]);
  }
}

?>
