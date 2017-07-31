<?php
require_once 'website/model/localizacion.model.php';
class LocalizacionController{

  private $localizacion;

  public function __CONSTRUCT(){
      $this->localizacion = new LocalizacionModel();
  }

  public function paises(){
    $result = $this->localizacion->cargaPais();
    return $result;
  }
}
?>
