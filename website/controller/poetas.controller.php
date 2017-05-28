<?php
require_once 'website/model/poetas.model.php';

class PoetasController{

  private $poetas; 

  public function __CONSTRUCT(){
      $this->poetas = new PoetasModel();
  }

  public function registroPoeta(){
      $data =  $_POST["data"];

      date_default_timezone_set('America/Bogota');
      $data[4] = rand(0, 900000000);
      $data[5] = rand(0, 900000000);
      $data[3] = password_hash($data[3], PASSWORD_DEFAULT);

      $result = $this->poetas->crearPoeta($data);

      echo json_encode($result);
  }



}
?>
