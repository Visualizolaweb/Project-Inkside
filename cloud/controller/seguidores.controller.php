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


      if(count($seguidores[0])<=0){
        $this->seguidores->seguir($poet_codigo, $micodigo);
      }else{

        $seguidores = explode(",",$seguidores[2]);

        foreach ($seguidores as $key) {
            if($poet_codigo != $key){
              $seguidor = TRUE;
            }else{
              $seguidor = FALSE;
              break;
            }
        }

        if($seguidor == TRUE){
          $this->seguidores->actualizarSeguidores($poet_codigo, $micodigo);
        }

      }
  }

  public function noseguirPoeta(){
      $poet_codigo = $_POST["poet_codigo"];
      $micodigo    = $_POST["micodigo"];
      $flag1       = true;
      $flag2       = false;

      $seguidores = $this->seguidores->buscarSeguidores($micodigo);
      $seguidores = explode(",",$seguidores[2]);

      $this->seguidores->limpiarSeguidores($micodigo);

      if($seguidores[0] == ""){
        unset($seguidores[0]);
      }


      foreach ($seguidores as $key) {
          if($poet_codigo != $key){
            if($flag1 == true){
               $this->seguidores->seguir($key, $micodigo);
               $flag1 = false;
            }else{
                $this->seguidores->actualizarSeguidores($key, $micodigo);
            }
          }
      }


  }

  public function misSeguidores($poet_codigo){
      $seguidores = $this->seguidores->seguidores($poet_codigo);
      return $seguidores;
  }


  public function yoSigo($poet_codigo){
      $seguidores = $this->seguidores->misSegidos($poet_codigo);
      return $seguidores;
  }

  public function miComunidad($misSeguidores){
      $MyComunidad = $this->seguidores->comunidad($misSeguidores);
      return $MyComunidad;
  }

  public function Comunidad(){
      $MyComunidad = $this->seguidores->comunidadInkside();
      return $MyComunidad;
  }

}
?>
