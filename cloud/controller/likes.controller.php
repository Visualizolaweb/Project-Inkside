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
      $totResultado = count($likesyAvatars);


      if($totResultado==0){
        echo '<div class="poets-like">Da tu primer like</div>';
      }elseif ($totResultado==1) {
        if($likesyAvatars[0]['poet_codigo']==$_SESSION["poeta"]["poet_codigo"]){
          echo '<div class="pic-profiles">
                  <a href="!#">
                    <ul>
                      <li><img src="'.$likesyAvatars[0]['poet_foto'].'"  class="thum-poem"/></li>
                    </ul>
                 </a>
               </div>';
            echo '<div class="poets-like">Te gusta esta publicación</div>';
        }else{
            echo '<div class="pic-profiles">
                  <a href="!#">
                    <ul>
                      <li><img src="'.$likesyAvatars[0]['poet_foto'].'"  class="thum-poem"/></li>
                    </ul>
                 </a>
               </div>';
            echo '<div class="poets-like">a <b>'.$likesyAvatars[0]['poet_nick'].'</b> le gusta publicación</div>';
        }
      }else{
      echo '<div class="pic-profiles">
              <a href="!#">
                <ul>';

                  if($totResultado >= 5){
                     $limiteResultado = 5;
                  }else{
                    $limiteResultado = $totResultado;
                  }

                  $i = 0;
                  while ($i < $limiteResultado) {
                    echo '<li><img src="'.$likesyAvatars[$i]['poet_foto'].'"  class="thum-poem"/></li>';
                    $i++;
                  }

                  --$i;
      echo '    </ul>
             </a>
           </div>';
           if($likesyAvatars[$i]['poet_codigo']==$_SESSION["poeta"]["poet_codigo"]){
              echo '<div class="poets-like">a <b>ti</b> y '.($totResultado - 1).' más les ha gustado este poema</div>';
           }else{
             echo '<div class="poets-like">a <b>'.$likesyAvatars[$i]['poet_nick'].'</b> y '.($totResultado - 1).' más les ha gustado este poema</div>';
           }
      }
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
