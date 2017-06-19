<?php
 require_once 'website/model/publicaciones.model.php';

class PublicacionesController{

  private $publicaciones;

  public function __CONSTRUCT(){
      $this->publicaciones = new PublicacionesModel();
  }

  public function poemas(){
    $result = $this->publicaciones->cargarPoemas();
    return $result;
  }

  public function articulos(){
    $result = $this->publicaciones->cargarArticulos();
    return $result;
  }

  public function cargarPublicacionbyID(){
     $pub_codigo = $_GET['pid'];
      $publicaciones = $this->publicaciones->cargabyId($pub_codigo);
      return $publicaciones;
  }

  public function otrasPublicaciones($poet_codigo){
     $result = $this->publicaciones->ultimaPublicacion($poet_codigo);
     return $result;
  }

  public function getSubString($string, $length=NULL){
    if ($length == NULL)
        $length = 230;
    $stringDisplay = substr(strip_tags($string), 0, $length);
    if (strlen(strip_tags($string)) > $length)
        $stringDisplay .= ' ...';
    return $stringDisplay;
 }

}
?>
