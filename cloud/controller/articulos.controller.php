<?php
 require_once 'model/articulos.model.php';

class ArticulosController extends InitController{

  private $articulos;

  public function __CONSTRUCT(){
      $this->articulos = new ArticulosModel();
  }

  public function detalle(){
      require_once 'views/include/structure-header-dashboard.php';
      require_once 'views/section/poems/detail.php';
      require_once 'views/include/structure-footer-dashboard.php';
  }

  public function guardarArticulo(){
    $data = $_POST["data"];
    $categorias = $_POST["cat"];
    $cat_text = implode(', ', $categorias);

      if($_SERVER["REQUEST_METHOD"] == "POST"){
          if(isset($_FILES["txt_imgPortada"]) && $_FILES["txt_imgPortada"]["error"] == 0){
              $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
              //$filename = $_FILES["txt_imgPortada"]["name"];
              $filetype = $_FILES["txt_imgPortada"]["type"];
              $filesize = $_FILES["txt_imgPortada"]["size"];

              $extension = pathinfo($_FILES['txt_imgPortada']['name']);
              $extension = ".".$extension['extension'];
              $var_rand=rand(10000,999999)* rand(10000,999999);
              $nombre_tem=md5($var_rand.$_FILES['txt_imgPortada']['name']);
              $filename=$nombre_tem.$extension;

              $extension = pathinfo($filename, PATHINFO_EXTENSION);

              if(!array_key_exists($extension, $allowed)) die("Error: Por favor seleccionar un formato valido (jpg, png o gif)");
              // Verify file size - 2MB maximum
              $maxsize = 2 * 1024 * 1024;
              if($filesize > $maxsize) die("Error: El tamaño del archivo es mayor al permitido (2MB).");
              // Verify MYME type of the file

              if(in_array($filetype, $allowed)){
                  // Check whether file exists before uploading it
                  if(file_exists("views/assets/images/portadasPoemas/" .$filename)){
                      echo $filename . " is already exists.";
                  } else{
                      move_uploaded_file($_FILES["txt_imgPortada"]["tmp_name"], "views/assets/images/portadasPoemas/" . $filename);
                  }
              } else{
                  echo "Error: Ha ocurrido un error al subir la imagen, intenta nuevamente.";
              }
          } else{
              echo "Error: " . $_FILES["txt_imgPortada"]["error"];
          }
      }
     $result = $this->articulos->crearArticulo($data,$cat_text,$filename);
        header("Location: mis-publicaciones");
  }


  public function guardarEvento(){
    $data = $_POST["data"];

      if($_SERVER["REQUEST_METHOD"] == "POST"){
          if(isset($_FILES["txt_imgPortada"]) && $_FILES["txt_imgPortada"]["error"] == 0){
              $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
              //$filename = $_FILES["txt_imgPortada"]["name"];
              $filetype = $_FILES["txt_imgPortada"]["type"];
              $filesize = $_FILES["txt_imgPortada"]["size"];

              $extension = pathinfo($_FILES['txt_imgPortada']['name']);
              $extension = ".".$extension['extension'];
              $var_rand=rand(10000,999999)* rand(10000,999999);
              $nombre_tem=md5($var_rand.$_FILES['txt_imgPortada']['name']);
              $filename=$nombre_tem.$extension;

              $extension = pathinfo($filename, PATHINFO_EXTENSION);

              if(!array_key_exists($extension, $allowed)) die("Error: Por favor seleccionar un formato valido (jpg, png o gif)");
              // Verify file size - 2MB maximum
              $maxsize = 2 * 1024 * 1024;
              if($filesize > $maxsize) die("Error: El tamaño del archivo es mayor al permitido (2MB).");
              // Verify MYME type of the file

              if(in_array($filetype, $allowed)){
                  // Check whether file exists before uploading it
                  if(file_exists("views/assets/images/portadasPoemas/" .$filename)){
                      echo $filename . " is already exists.";
                  } else{
                      move_uploaded_file($_FILES["txt_imgPortada"]["tmp_name"], "views/assets/images/portadasPoemas/" . $filename);
                  }
              } else{
                  echo "Error: Ha ocurrido un error al subir la imagen, intenta nuevamente.";
              }
          } else{
              echo "Error: " . $_FILES["txt_imgPortada"]["error"];
          }
      }
     $result = $this->articulos->crearEvento($data,$filename);
        header("Location: mis-publicaciones");
  }

}
?>
