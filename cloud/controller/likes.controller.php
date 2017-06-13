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

  public function likesConAvatar($pub_codigo){
      $likesyAvatars = $this->likes->likesAvatar($pub_codigo);
      // echo "<br>total likes ". $totResultado = count($likesyAvatars);


      // if($totResultado==0){
      //   echo '<div class="poets-like">Da tu primer like</div>';
      // }elseif($totResultado>5) {
      // echo '<div class="pic-profiles">
      //         <a href="!#">
      //           <ul>';
      //             $a = 0;
      //             while ($a < 5) {
      //               echo '<li><img src="'.$likesyAvatars['poet_foto'].'"  class="thum-poem"/></li>';
      //               $a++;
      //             }
      // echo '    </ul>
      //        </a>
      //      </div>';
      // echo '<div class="poets-like"><b>'.$likesyAvatars['poet_nick'].'</b> y '.$totResultado.' más les ha gustado este poema</div>';
      // }





  // echo '<div class="pic-profiles">
  //         <a href="!#">
  //           <ul>
  //             <li><img src="views/assets/images/perfil/avatar1-sm.jpg"  class="thum-poem"/></li>
  //             <li><img src="views/assets/images/perfil/avatar41-sm.jpg" class="thum-poem"/></li>
  //             <li><img src="views/assets/images/perfil/avatar42-sm.jpg" class="thum-poem"/></li>
  //             <li><img src="views/assets/images/perfil/avatar43-sm.jpg" class="thum-poem"/></li>
  //             <li><img src="views/assets/images/perfil/avatar63-sm.jpg" class="thum-poem"/></li>
  //           </ul>
  //         </a>
  //       </div>
  //       <div class="poets-like"><b>Diana</b> y 20 más les ha gustado este poema</div>';
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
