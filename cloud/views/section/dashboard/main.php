<?php
  require_once("controller/poemas.controller.php");
  $poemas = new PoemasController();
  $poemasContent = $poemas->poemas();

  require_once("controller/poetas.controller.php");
  $poetas = new PoetasController();

  require_once("controller/comentarios.controller.php");
  $comentarios = new ComentariosController();

  if(!isset($_SESSION["poeta"]["poet_codigo"])){
     $codigoPoeta = $poetas->cargaCodigoPoeta();
     $_SESSION["poeta"]["poet_codigo"] = $codigoPoeta["poet_codigo"];
  }


  $topMisPoemas = $poemas->misMasleidos($_SESSION["poeta"]["poet_codigo"]);


  require_once("controller/likes.controller.php");
  $likes = new likesController();

?>
<section id="wrap-container">
  <div class="row container-fluid wrap-panes">
      <div class="col l3">

        <!-- Widget Poetas Sugeridos -->
        <div class="panel">
          <div class="panel-title">Poetas Sugeridos</div>

          <ul class="collection" id="Suggest">
            <?php
                $poetasSugeridos = $poetas->cargaPoetasSugeridos();
                foreach ($poetasSugeridos as $sugeridos) {
                  if($sugeridos['pdesc_avatar']!=''){
                    $avatar = $sugeridos['pdesc_avatar'];
                  }else{
                    $avatar = $sugeridos['poet_foto'];
                  }
                  echo '<li class="collection-item avatar" id='.$sugeridos['poet_codigo'].'>
                    <img src="'.$avatar.'" alt="" class="circle">
                    <span class="title">'.$sugeridos['poet_nick'].'</span>
                    <p>'.$sugeridos['ciu_nombre'].'</p>
                    <a href="javascript:void(0)" onclick="add_poet(\''.$_SESSION["poeta"]["poet_codigo"].'\',\''.$sugeridos['poet_codigo'].'\')" class="secondary-content "><i class="fa fa-heart-o"></i></a>
                  </li>';
                }
            ?>
          </ul>

        </div>

        <!-- Widget - Tu publicaciones mas vistas -->
        <div class="panel">
          <div class="panel-title">Tus 5 poemas más leidos</div>
          <div class="collection">
            <?php
              foreach ($topMisPoemas as $puesto) {
                if($puesto["pub_hits"] >= 10){
                  $color = "green";
                }elseif($puesto["pub_hits"] == 1){
                  $color = "blue-grey lighten-5 black-text";
                }else{
                  $color = "";
                }

                echo '<a href="#!" class="collection-item"><span class="new badge '.$color.'" data-badge-caption="Vistas">'.$puesto["pub_hits"].'</span>'.$puesto["pub_titulo"].'</a>';
              }

            ?>
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
            $allLikes = count($totalLikes);

            $totalcomentarios = $comentarios->comentarios($content['pub_codigo']);
            $allCoementarios = count($totalcomentarios);

            foreach ($totalLikes as $milike) {
                if($milike['codigo']==$_SESSION["poeta"]["poet_codigo"]){
                  $classLike = "fa fa-heart";
                  $accion = "unlike";
                }else{
                  $classLike = "fa fa-heart-o";
                  $accion = "like";
                }
              }

            if($allLikes <= 0){
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
                  <a href="javascript:void(0)" onClick="addLikes(\''.$content["pub_codigo"].'\',\''.$accion.'\',\''.$allLikes.'\')"><li><i class="fa fa-heart"></i></li></a>
                  <a href="pubID'.$content["pub_codigo"].'"><li><i class="fa fa-comments"></i></li></a>
                  <a href="javascript:void(0)" onClick="dedicaPoema(\''.$content["pub_codigo"].'\',\''.$_SESSION["poeta"]["poet_codigo"].'\')"><li><i class="fa fa-bullhorn"></i></li></a>
                  </ul>
                </div>

                 <div class="post__author author vcard inline-items">
      							<img src="'.$avatarPublic.'" alt="author" data-pin-nopin="true">

      							<div class="author-date">
      								<a class="h6 post__author-name fn" href="#">'.$content["poet_nick"].'</a>
      								<div class="post__date">
      									<time class="published" datetime="'.$content["pub_fechaPublicacion"].'T18:18">
      									   '.$content["pub_fechaPublicacion"].'
      									</time>
      								</div>
      							</div>
        				</div>

                <div class="post__content">
                  <h3>'.$content["pub_titulo"].'</h3>

                  '.$Content.'

                  <div class="more-detail right-align "><a href="pubID'.$content["pub_codigo"].'" class="teal-text">Leer más</a></div>
                </div>

                <div class="post__aditional row">
                  <div class="favorite col l2" id="like-'.$content["pub_codigo"].'">
                    <a  href="javascript:void(0)" onClick="addLikes(\''.$content["pub_codigo"].'\',\''.$accion.'\',\''.$allLikes.'\')" data-position="top" data-delay="50" data-tooltip="A '. $allLikes .' personas les ha gustado este poema">
                      <i class="'.$classLike.'"></i> '.$allLikes.'
                    </a>
                  </div>

                  <div class="user-likes col l7">';
                    $likes->likesConAvatar($content['pub_codigo']);
            echo '</div>
                  <div class="comments col l3 center">
                    <a href="!#" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="Este poema cuenta con '.$allCoementarios.' comentarios"><i class="fa fa-comments"></i> '.$allCoementarios.'</a>
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
