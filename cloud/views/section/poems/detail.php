<?php
require_once("controller/publicaciones.controller.php");
$publicaciones = new PublicacionesController();
$detalle = $publicaciones->cargarPublicacionbyID($_GET["pid"]);

if($detalle["pdesc_avatar"] == ""){
   $avatar = $detalle["poet_foto"];
}else{
  $avatar = $detalle["pdesc_avatar"];
}
?>


<section id="wrap-container">
  <div class="row container-fluid wrap-panes">

      <div class="col l8">


        <!-- Widget - Poemas -->

        <div class="panel poem">
          <div class="control-button">
            <ul>
              <a href="!#"><li><i class="fa fa-heart"></i></li></a>
              <a href="!#"><li><i class="fa fa-bullhorn"></i></li></a>
            </ul>
          </div>

           <div class="post__author author vcard inline-items">
							<img src="<?php echo $avatar ?>" alt="author" data-pin-nopin="true">

							<div class="author-date">
								<a class="h6 post__author-name fn" href="#"><?php echo $detalle["poet_nick"] ?></a>
								<div class="post__date">
									<time class="published" datetime="2017-03-24T18:18">
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
      </div>

      <!-- COMENTARIOS -->
      <div class="col l4">
           <div class="panel comments">
            <div class="panel-title">Deja tu comentario!
            <div style="position: absolute; right: 15px;"><a class="btn-floating right waves-effect waves-light amber darken-2 z-depth-0"><i class="fa fa-save"></i></a></div></div>
            <form>
              <textarea placeholder="Comparte tus ideas con el autor..."></textarea>
            </form>
        </div>

        <div class="panel">
         <div class="panel-title">Comentarios sobre esta publicación</div>
         <ul class="collection">
             <li class="collection-item avatar">
               <img src="views/assets/images/perfil/avatar38-sm.jpg" alt="" class="circle">
               <span class="title">Nicolás Ramírez</span>
               <p>Que gústo volver a saber de vos por aquí. Ya habían pasado años que no publicabas. No te pierdas poeta. Saludos.</p>
               <!-- <a href="#!"><small>+ 8</small> <i class="fa fa-thumbs-o-up"></i> </a>
               <a href="#!"><small>0</small> <i class="fa fa-thumbs-o-down"></i></a> -->
             </li>

          </ul>
       </div>
      </div>
    </div>
</section>
