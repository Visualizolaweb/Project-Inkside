<?php
require "model/likes.model.php";

class likesController{

  private $likes;

  public function __CONSTRUCT(){
      $this->likes = new LikesModel();
  }

  public function likes($pub_codigo){
      $likes = $this->likes->likesByPublicacion($pub_codigo);
      return $likes;
  }

  public function likePublicacion(){
    $pub_codigo = $_POST['pub_codigo'];
    $accion = $_POST['accion'];
    $poet_codigo = $_SESSION['poeta']['poet_codigo'];

    if($accion == "like"){
       $this->likes->guardarLike($pub_codigo, $poet_codigo);
       echo "like";
     }else{
       $this->likes->eliminarLike($pub_codigo, $poet_codigo);
       echo "unlike";
    }



  }

}

?>
