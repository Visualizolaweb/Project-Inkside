<?php
require_once("controller/publicaciones.controller.php");
require_once("controller/comentarios.controller.php");
require_once("controller/poetas.controller.php");
require_once("controller/likes.controller.php");

$likes = new likesController();
$poetas = new PoetasController();
$publicaciones = new PublicacionesController();
$comentarios   = new ComentariosController();

$detalle = $publicaciones->cargarPublicacionbyID($_GET["pid"]);
$publicaciones->guardarHits($_GET["pid"]);

$totalLikes = $likes->likes($_GET["pid"]);
$allLikes = count($totalLikes);

$totalcomentarios = $comentarios->comentarios($_GET["pid"]);
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

if($detalle["pdesc_avatar"] == ""){
   $avatar = $detalle["poet_foto"];
}else{
  $avatar = $detalle["pdesc_avatar"];
}

$cargacomentarios = $comentarios->comentarios($_GET["pid"]);

?>

<section id="wrap-container">
  <div class="row container-fluid wrap-panes">

      <div class="col l8">
        <!-- Widget - Poemas -->

        <div class="panel poem">
          <div class="control-button">
            <ul>
              <?php

        echo '  <a href="javascript:void(0)" onClick="dedicaPoema(\''.$_GET["pid"].'\',\''.$_SESSION["poeta"]["poet_codigo"].'\')"><li><i class="fa fa-bullhorn"></i></li></a>';

               ?>
            </ul>
          </div>

           <div class="post__author author vcard inline-items">
							<img src="<?php echo $avatar ?>" alt="author" data-pin-nopin="true">

							<div class="author-date">
								<a class="h6 post__author-name fn" href="#"><?php echo $detalle["poet_nick"] ?></a>
								<div class="post__date">
									<time class="published" datetime="<?php echo $detalle["pub_fechaPublicacion"]; ?>T18:18">
									   Publicado el <?php echo $detalle["pub_fechaPublicacion"] ?>.
									</time>
								</div>
							</div>
  				</div>

          <div class="post__content">
            <h3><?php echo $detalle["pub_titulo"]; ?></h3>
                <?php echo $detalle["pub_contenido"]; ?>
          </div>

          <div class="post__aditional row">
            <div class="favorite col l2"  id="like-<?php echo $_GET["pid"]?>">
              <a href="javascript:void(0)" onClick="<?php echo 'addLikes(\''.$_GET["pid"].'\',\''.$accion.'\',\''.$allLikes.'\')' ?>" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="A <?php echo $allLikes?> personas les ha gustado este poema">
                <i class="<?php echo $classLike ?>"></i> <?php echo $allLikes ?>
              </a>
            </div>

            <div class="user-likes col l7">
              <?php $likes->likesConAvatar($_GET["pid"]); ?>
            </div>
            <div class="comments col l3 center">
              <a href="!#" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="Este poema cuenta con <?php echo count($cargacomentarios)?> comentarios"><i class="fa fa-comments"></i> <?php echo count($cargacomentarios)?></a>
              &nbsp;
              <a href="!#" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="A <?php echo $detalle["pub_dedicatorias"]; ?> personas se les ha dedicado este poema"><i class="fa fa-bullhorn"></i> <?php echo $detalle["pub_dedicatorias"]; ?></a>
            </div>
          </div>
        </div>
      </div>

      <!-- COMENTARIOS -->
      <div class="col l4">
           <div class="panel comments">
            <div class="panel-title">Deja tu comentario!
            <div style="position: absolute; right: 15px;"><a id="btncomentarios" class="btn-floating right waves-effect waves-light amber darken-2 z-depth-0"><i class="fa fa-save"></i></a></div></div>
            <form id="frmcomentario" method="post" action="crear-comentario">
              <input type="hidden" name="data[0]" value="<?php echo $_SESSION["poeta"]["poet_codigo"]?>">
              <input type="hidden" name="data[1]" value="<?php echo $_GET["pid"] ?>">
              <textarea placeholder="Comparte tus ideas con el autor..." name="data[2]"></textarea>
            </form>
        </div>

        <div class="panel">
         <div class="panel-title">Comentarios sobre esta publicación</div>
         <ul class="collection">
            <?php
            foreach ($cargacomentarios as $comentario) {

              if($comentario["pdesc_avatar"] == ""){
                 $avatarComentario = $comentario["poet_foto"];
              }else{
                $avatarComentario = $comentario["pdesc_avatar"];
              }

              echo '<li class="collection-item avatar">
                    <img src="'.$avatarComentario.'" alt="" class="circle">
                    <span class="title">'.$comentario["poet_nick"].'</span>
                    <p>'.$comentario["com_comentario"].'</p>
                  </li>';
            }

            ?>

          </ul>
       </div>
      </div>
    </div>
</section>
