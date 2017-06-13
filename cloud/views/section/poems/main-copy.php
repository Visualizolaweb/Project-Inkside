<?php
  require_once("controller/poemas.controller.php");
  $poemas = new PoemasController();
  $poemasContent = $poemas->poemas();
?>
<section id="wrap-container">
  <div class="row container-fluid wrap-panes">


      <div class="col l12">

        <!-- Widget - Bienvenido -->
        <div class="panel message">
          <div class="icon-message cyan accent-3"><i class="fa fa-star"></i></div>
          <p>Aquí podrás ver los poemas sugeridos según tus gustos</p>
        </div>

        <!-- Widget - Poemas -->

        <?php
          foreach ($poemasContent as $content) {
            $Content = $poemas->getSubString($content["pub_contenido"]);
            if($content["pub_fechaPublicacion"]==(date('Y-m-d'))){
              $content["pub_fechaPublicacion"] = "Publicado hoy";
            }else{
              $content["pub_fechaPublicacion"] = "Publicado el: ".$content["pub_fechaPublicacion"];
            }

            echo '
            <div class="col m6 s12">
            <div class="panel poem">
              <div class="control-button">
                <ul>
                <a href="!#"><li><i class="fa fa-heart"></i></li></a>
                <a href="!#"><li><i class="fa fa-comments"></i></li></a>
                <a href="!#"><li><i class="fa fa-bullhorn"></i></li></a>
                </ul>
              </div>

               <div class="post__author author vcard inline-items">
                  <img src="views/assets/images/portadasPoemas/'.$content["poet_foto"].'" alt="author" data-pin-nopin="true">

                  <div class="author-date">
                    <a class="h6 post__author-name fn" href="#">'.$content["poet_nick"].'</a>
                    <div class="post__date">
                      <time class="published" datetime="2017-03-24T18:18">
                         '.$content["pub_fechaPublicacion"].'
                      </time>
                    </div>
                  </div>
              </div>


                <div class="post__content">
                  <h3>'.$content["pub_titulo"].'</h3>

                  '.$Content.'

                  <div class="more-detail right-align "><a href="cuando-ya-no-este" class="teal-text"><i class="fa fa-circle"></i> <i class="fa fa-circle"></i> <i class="fa fa-circle"></i></a></div>
                </div>

                <div class="post__aditional row">
                  <div class="favorite col l2">
                    <a href="!#" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="A 21 personas les ha gustado este poema"><i class="fa fa-heart-o"></i> 21</a>
                  </div>

                  <div class="user-likes col l7">
                    <div class="pic-profiles">
                    <a href="!#">
                      <ul>
                        <li><img src="views/assets/images/perfil/avatar1-sm.jpg"  class="thum-poem"/></li>
                        <li><img src="views/assets/images/perfil/avatar41-sm.jpg" class="thum-poem"/></li>
                        <li><img src="views/assets/images/perfil/avatar42-sm.jpg" class="thum-poem"/></li>
                        <li><img src="views/assets/images/perfil/avatar43-sm.jpg" class="thum-poem"/></li>
                        <li><img src="views/assets/images/perfil/avatar63-sm.jpg" class="thum-poem"/></li>
                      </ul>
                    </a>
                    </div>
                    <div class="poets-like"><b>Diana</b> y 20 más les ha gustado este poema</div>
                  </div>
                  <div class="comments col l3 center">
                    <a href="!#" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="Este poema cuenta con 2 comentarios"><i class="fa fa-comments"></i> 2</a>
                    &nbsp;
                    <a href="!#" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="A 13 personas se les ha dedicado este poema"><i class="fa fa-bullhorn"></i> 13</a>
                  </div>
                </div>
              </div>
            </div>';
          }
        ?>


      </div>


    </div>
</section>
