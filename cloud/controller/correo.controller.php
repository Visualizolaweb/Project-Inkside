<?php
require_once 'model/correo.model.php';

class CorreoController extends InitController{

  private $correo;

  public function __CONSTRUCT(){
      $this->correo = new CorreoModel();
  }

  public function cargarMensajes(){
     $result = $this->correo->MisMensajes($_SESSION["poeta"]["poet_codigo"]);
     return $result;
  }

}
?>
