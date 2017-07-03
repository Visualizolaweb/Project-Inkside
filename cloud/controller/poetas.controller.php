<?php
require_once 'model/poetas.model.php';

class PoetasController extends InitController{

  private $poetas;

  public function __CONSTRUCT(){
      $this->poetas = new PoetasModel();
  }

  public function actualizarDatoPoeta(){
     $data = $_POST["data"];

     $_SESSION["poeta"]["poet_nick"] = $data[3];

     $result = $this->poetas->actualizarPoeta($data);
     header("Location: mis-datos");
  }

  public function buscarDatoPoeta(){
     $result = $this->poetas->datosPoetaFull($_SESSION["poeta"]["poet_codigo"]);
     return $result;
  }

  public function buscarDatoPoetaInner($poet_codigo){
     $result = $this->poetas->datosPoetaFull($poet_codigo);
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

  public function poetasRol($rol){
    $result = $this->poetas->poetasPorRol($rol);
    return $result;
  }

  public function updateAvatar(){
    $data = $_POST["image"];
    $code = $_POST["code"];
    $replace = array(":","-",".");
    $file = "views/assets/images/perfil/";
    $name = strtolower(str_replace($replace,"",$code));

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);

    $data = base64_decode($data);
    $imageName = $file.$name.'.png';
    file_put_contents($imageName, $data);

    $_SESSION["poeta"]["poet_foto"] = $imageName;
    $result = $this->poetas->actualizoAvatar($imageName,$code);

    return $result;
  }

  public function guardoPerfil(){
    $data      = $_POST["data"];
    $categoria = $_POST["cat"];

    $this->poetas->actualizoPerfil($data,$categoria);
    header("Location: dashboard");
  }

}
?>
