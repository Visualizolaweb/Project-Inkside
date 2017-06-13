<?php
require_once "../vendor/autoload.php";
require_once 'model/poetas.model.php';
require_once 'model/publicaciones.model.php';

class EnviosController extends InitController{

  private $poetas;
  private $publicaciones;

  public function __CONSTRUCT(){
      $this->poetas = new PoetasModel();
      $this->publicaciones = new PublicacionesModel();
  }


  public function dedicatoria(){
    $pub_codigo  = $_POST["pub_codigo"];
    $poet_codigo = $_POST["poet_codigo"];
    $email       = $_POST["email"];

    $poeta = $this->poetas->datosPoeta($poet_codigo);
    $retorno = InitController::sendDedicatoria($poeta, $pub_codigo, $email);
    $this->publicaciones->dedicatoria($pub_codigo);

    echo $retorno[1];
  }
}
