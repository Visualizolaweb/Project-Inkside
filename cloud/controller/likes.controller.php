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

}

?>
