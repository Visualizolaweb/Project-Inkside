<?php
require_once 'model/poetas.model.php';

class PoetasController extends InitController{

  private $poetas;

  public function __CONSTRUCT(){
      $this->poetas = new PoetasModel();
  }

  public function actualizarDatoPoeta(){
     $data = $_POST["data"];
     $result = $this->poetas->actualizarPoeta($data);
     header("Location: mis-datos");
  }

  public function buscarDatoPoeta(){
     $result = $this->poetas->datosPoeta($_SESSION["poeta"]["poet_codigo"]);
     return $result;
  }

  public function cargaPoetasSugeridos(){
     $totalPoetas = $this->poetas->contarPoetas();
     $poetasAleatorios = rand(0, $totalPoetas['totalPoetas']-1);
     $result = $this->poetas->poetasSugeridos($poetasAleatorios);
     return $result;
  }

  public function cargaCodigoPoeta(){
    $result = $this->poetas->cargaCodigobySocialID($_SESSION["poeta"]["acc_social_id"]);
    return $result;
  }

}
?>
