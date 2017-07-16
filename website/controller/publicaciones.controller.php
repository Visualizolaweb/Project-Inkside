<?php
 require_once 'website/model/publicaciones.model.php';

class PublicacionesController{

  private $publicaciones;

  public function __CONSTRUCT(){
      $this->publicaciones = new PublicacionesModel();
  }

  public function poemas($desde, $hasta){
    if(!isset($hasta)){
      $limit = "";
    }else{
      $limit = "LIMIT ".$desde." , ".$hasta;
    }
    $result = $this->publicaciones->cargarPoemas($limit);
    return $result;
  }

  public function poemasporPoeta($desde, $hasta, $poet_codigo){
    if(!isset($hasta)){
      $limit = "";
    }else{
      $limit = "LIMIT ".$desde." , ".$hasta;
    }
    $result = $this->publicaciones->cargarPoemasporPoeta($limit, $poet_codigo);
    return $result;
  }


  public function noticias($desde, $hasta){
    if(!isset($hasta)){
      $limit = "";
    }else{
      $limit = "LIMIT ".$desde." , ".$hasta;
    }
    $result = $this->publicaciones->cargarNoticias($limit);
    return $result;
  }

  public function eventos($desde, $hasta){
    if(!isset($hasta)){
      $limit = "";
    }else{
      $limit = "LIMIT ".$desde." , ".$hasta;
    }
    $result = $this->publicaciones->cargarEventos($limit);
    return $result;
  }

  public function cuentaPoemas(){
    $limit = "";
    $result = $this->publicaciones->cargarPoemas($limit);
    return count($result);
  }

  public function cuentaPoemasporPoeta($poet_codigo){
    $limit = "";
    $result = $this->publicaciones->cargarPoemasporPoeta($limit, $poet_codigo);
    return count($result);
  }

  public function cuentaNoticias(){
    $limit = "";
    $result = $this->publicaciones->cargarNoticias($limit);
    return count($result);
  }

  public function cuentaeEventos(){
    $limit = "";
    $result = $this->publicaciones->cargarEventos($limit);
    return count($result);
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

  public function otrasPublicaciones($poet_codigo,$pub_codigo){
     $result = $this->publicaciones->otraPublicacion($poet_codigo,$pub_codigo);
     return $result;
  }


  public function recomendados($pub_codigo){
     $result = $this->publicaciones->verRecomendados($pub_codigo);
     return $result;
  }

  public function otrasNoticias($pub_codigo){
     $result = $this->publicaciones->verNoticias($pub_codigo);
     return $result;
  }

  public function otrosEventos($pub_codigo){
     $result = $this->publicaciones->verEventos($pub_codigo);
     return $result;
  }

  public function getSubString($string){

    $stringDisplay = strtr("prueba","<br><br>",$string);
    return $stringDisplay;
 }

 function fechaesp($date) {
    $dia = explode("-", $date, 3);
    $year = $dia[0];
    $month = (string)(int)$dia[1];
    $day = (string)(int)$dia[2];

    $dias = array("Domingo","Lunes","Martes","Miércoles" ,"Jueves","Viernes","Sábado");
    $tomadia = $dias[intval((date("w",mktime(0,0,0,$month,$day,$year))))];

    $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    return $tomadia.", ".$day." de ".$meses[$month]." de ".$year;
}

function cargaComentarios($pub_codigo){
  $result = $this->publicaciones->cargaComentarios($pub_codigo);
  return $result;
}


}
?>
