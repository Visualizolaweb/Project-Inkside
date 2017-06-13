<?php
  require_once("controller/poemas.controller.php");
  $poemas = new PoemasController();
  $poemasContent = $poemas->poemas();

  require_once("controller/poetas.controller.php");
  $poetas = new PoetasController();
  $poetasSugeridos = $poetas->cargaPoetasSugeridos();

  require_once("controller/likes.controller.php");
  $likes = new likesController();

?>
<section id="wrap-container">
  <div class="row container-fluid wrap-panes">
      <div class="col l3">

        <!-- Widget Poetas Sugeridos -->
        <div class="panel">
          <div class="panel-title">Poetas Sugeridos</div>

          <ul class="collection">
            <?php
                foreach ($poetasSugeridos as $sugeridos) {
                  if($sugeridos['pdesc_avatar']!=''){
                    $avatar = $sugeridos['pdesc_avatar'];
                  }else{
                    $avatar = $sugeridos['poet_foto'];
                  }
                  echo '<li class="collection-item avatar">
                    <img src="'.$avatar.'" alt="" class="circle">
                    <span class="title">'.$sugeridos['poet_nick'].'</span>
                    <p>'.$sugeridos['ciu_nombre'].'</p>
                    <a href="#!" class="secondary-content add-poet"><i class="fa fa-heart-o"></i></a>
                  </li>';
                }
            ?>
          </ul>

        </div>

        <!-- Widget - Tu publicaciones mas vistas -->
        <div class="panel">
          <div class="panel-title">Tus publicaciones más vistas</div>
          <div class="collection">
              <a href="#!" class="collection-item"><span class="new badge green" data-badge-caption="Vistas">18</span>Besos Con sonrisa</a>
              <a href="#!" class="collection-item"><span class="new badge" data-badge-caption="Vistas">4</span>Emanuel Luna</a>
              <a href="#!" class="collection-item"><span class="new badge blue-grey lighten-5 black-text"  data-badge-caption="Vista">1</span>Preguntas de Dos Amantes</a>
            </div>
        </div>
      </div>

      <div class="col l6">

        <!-- Widget - Bienvenido -->
        <div class="panel message">
          <div class="icon-message cyan accent-3"><i class="fa fa-star"></i></div>
          <p>Aquí podrás ver los poemas sugeridos según tus gustos</p>
        </div>

        <!-- Widget - Poemas -->

        <?php
          foreach ($poemasContent as $content) {
            $totalLikes = $likes->likes($content['pub_codigo']);
            $allLikes = count($totalLikes['poet_codigo']);
            if($totalLikes['poet_codigo']==$_SESSION["poeta"]["poet_codigo"]){
              $classLike = "fa fa-heart";
              $accion = "unlike";
            }else{
              $classLike = "fa fa-heart-o";
              $accion = "like";
            }

            if($content['pdesc_avatar']!=''){
              $avatarPublic = $content['pdesc_avatar'];
            }else{
              $avatarPublic = $content['poet_foto'];
            }

            $Content = $poemas->getSubString($content["pub_contenido"]);

              if($content["pub_fechaPublicacion"]==(date('Y-m-d'))){
                $content["pub_fechaPublicacion"] = "Publicado hoy";
              }else{
                $content["pub_fechaPublicacion"] = "Publicado el: ".$content["pub_fechaPublicacion"];
              }

              echo '<div class="panel poem">
                <div class="control-button">
                  <ul>
                  <a href="!#"><li><i class="fa fa-heart"></i></li></a>
                  <a href="!#"><li><i class="fa fa-comments"></i></li></a>
                  <a href="!#"><li><i class="fa fa-bullhorn"></i></li></a>
                  </ul>
                </div>

                 <div class="post__author author vcard inline-items">
      							<img src="'.$avatarPublic.'" alt="author" data-pin-nopin="true">

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
                  <div class="favorite col l2" id="like-'.$content["pub_codigo"].'">
                    <a  href="javascript:void(0)" onClick="addLikes(\''.$content["pub_codigo"].'\',\''.$accion.'\',\''.$allLikes.'\')" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="A '. $allLikes .' personas les ha gustado este poema">
                      <i class="'.$classLike.'"></i> '.$allLikes.'
                    </a>
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
              </div>';
          }
        ?>
      </div>

      <div class="col l3">
        <div class="poem-create">
          <div>
            <i class="fa fa-pencil"></i>
            <h4>Crea tu poema y expresa tus pensamientos</h4>
            <a href="crear-poema" class="btn-link">Crea tu poema</a>
          </div>
        </div>

        <div class="panel followers">
            <div class="panel-title">Poetas que te siguen!</div>
            <ul>
              <li><img src="views/assets/images/perfil/avatar42-sm.jpg"/></li>
              <li><img src="views/assets/images/perfil/avatar1-sm.jpg"/></li>
              <li><img src="views/assets/images/perfil/avatar41-sm.jpg"/></li>
              <li><img src="views/assets/images/perfil/avatar43-sm.jpg"/></li>
              <li><img src="views/assets/images/perfil/avatar46-sm.jpg"/></li>
              <li><img src="views/assets/images/perfil/avatar60-sm.jpg"/></li>
            </ul>
        </div>
      </div>
    </div>
</section>
