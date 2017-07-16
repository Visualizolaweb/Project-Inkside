<?php
  require_once 'website/controller/publicaciones.controller.php';
  require_once 'website/controller/categorias.controller.php';

  $publicaciones = new PublicacionesController();
  $categorias    = new CategoriasController();

  $contenido = $publicaciones->cargarPublicacionbyID();
  $otraPublicacion = $publicaciones->otrasPublicaciones($contenido['poet_codigo'],$_GET['pid']);

  $contenidoSub = $publicaciones->getSubString($otraPublicacion['pub_contenido']);

  $comentarios = $publicaciones->cargaComentarios($_GET['pid']);

  require_once 'website/controller/poetas.controller.php';
  $poetas = new PoetasController();
  $poeta = $poetas->buscarDatoPoeta($contenido['poet_codigo']);


  if($poeta['pdesc_avatar']=='') {
    $delimitador = explode("/",$poeta['poet_foto']);
    if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
      $avatar = $poeta['poet_foto'];
    }else{
      $avatar = "cloud/".$poeta['poet_foto'];
    }
  }else{
    $avatar = 'cloud/'.$poeta['pdesc_avatar'];
  }
?>
<script> document.title = '<?php echo $contenido['pub_titulo'] ?>'; </script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-594dd14013b1707e"></script>

<!-- VISTA DETALLE POEMA -->
<?php if($contenido['pub_categoria'] == 'Poema'){ ?>

<div class="container wrap detail-poem">
  <div class="row">
    <div class="col s12 m7 l7">
      <?php
      if(isset($contenido['pub_imgPortada'])){ ?>
      <div class="row">
        <div class="col l12">
          <img src="cloud/views/assets/images/portadasPoemas/<?php echo $contenido['pub_imgPortada'] ?>" alt="<?php echo $contenido['pub_titulo']; ?>">
        </div>
      </div>
      <?php  } ?>

      <div id="social-detail" class="row">
        <div class="col l3"><i class="fa fa-eye"></i><?php echo $contenido['pub_hits']; ?></div>
        <div class="col l7 right right-align">
          <i class="fa fa-comments-o"></i><?php echo count($comentarios); ?>&nbsp;
          <i class="fa fa-paper-plane"></i><?php echo $contenido['pub_dedicatorias']; ?>&nbsp;
          <i class="fa fa-heart red-text"></i><?php echo $contenido['pub_likes']; ?>
        </div>
      </div>
      <div id="dedicate" class="right">
        <a href="javascript:void(0)" onclick="dedicatoria()" style="text-transform: initial" class="waves-effect waves-light blue-grey lighten-4 btn z-depth-0 btn-icon"><i class="fa fa-paper-plane icon-button  pink accent-3"></i>Dedica este poema</a>
      </div>

      <article class="row">
        <div id="title"><h1><?php echo $contenido["pub_titulo"]; ?></h1></div>
        <div id="postDate"><em>Publicado el <?php echo $publicaciones->fechaesp($contenido['pub_fechaPublicacion']); ?> </em></div>
        <div id="content"><?php echo strip_tags($contenido["pub_contenido"], '<p><br>'); ?></div>
        <div id="tags">
          <ul>
          <?php
            foreach ($categorias->categoriabyId($contenido['catePub_codigo']) as $key => $value) {
              echo '<li   class="chip teal lighten-5">'.$value["catePub_nombre"].'</li>';
            }
          ?>
          </ul>
        </div>
      </article>

      <section id="comments" class="row">
        <div class="center-align"><em>- Para realizar comentarios debes iniciar sesión con tu cuenta de InkSide -</em></div><br>

        <?php if(count($comentarios)>0){ ?>

        <div class="col l6"><h5>Comentarios</h5></div>
        <div class="col l6 right-align"><h6><?php echo count($comentarios); ?> Comentarios</h6></div>

        <div class="row">
        <div class="col s12">

          <?php
            foreach ($comentarios as $comentario) {

                if($comentario['pdesc_avatar']=='') {
                  $delimitador = explode("/",$comentario['poet_foto']);
                  if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
                    $avatar_comment = $comentario['poet_foto'];
                  }else{
                    $avatar_comment = "cloud/".$comentario['poet_foto'];
                  }
                }else{
                  $avatar_comment = 'cloud/'.$comentario['pdesc_avatar'];
                }

          ?>

          <div class="card grey lighten-3 z-depth-0">
            <div class="card-content ">
              <div class="card-title">
                <div id="author-comment" class="col s12">
                  <img src="<?php echo $avatar_comment?>" class="circle">
                   <p><span><?php echo $comentario["poet_nick"]?></span><em>Comentado el <?php echo $comentario["com_fecha"]?></em></p>
                </div>
              </div>

              <p id="article-comment"><?php echo $comentario["com_comentario"]; ?></p>
            </div>
            <!-- <div class="card-action">
              <a href="#">This is a link</a>
              <a href="#">This is a link</a>
            </div> -->
          </div>

          <?php } ?>

        </div>
      </div>
      <?php }else{ ?>
      <div class="col l12 center-align"><h5>Este poema aún no tiene comentarios</h5></div>
      <?php } ?>

      </section>
    </div>

    <div id="aboutPoet" class="col s12 m4 l4 right">
      <div class="row">
        <div class="col s12">
          <h2 style="text-transform:initial">Sobre el autor</h2>
        </div>

        <div class="col s12 center-align">
          <a href="poeta-<?php echo base64_encode($contenido['poet_codigo']) ?>"><img src="<?php echo $avatar?>" class="avatar circle"></a>
        </div>

        <div class="col s12 center-align">
          <h5><a href="poeta-<?php echo base64_encode($contenido['poet_codigo']) ?>"><?php echo ucwords($poeta['poet_nick'])?></a></h5>
          <?php if(isset($poeta['pdesc_acerca'])){
             echo "<p class='center-align'>".$poeta['pdesc_acerca']."</p>";
          }?>

          <button onclick="followPoet()" type="button" class="center waves-effect waves-light btn amber accent-3 z-depth-0 btn-icon"><i class="fa fa-plus icon-button orange"></i>Seguir al poeta</button>
          <br><br><em style="display:block">- Leer más del autor -</em>

          <div class="row">
            <div class="col s12">
              <div class="card blue-grey darken-1">
                <div class="card-content white-text" style="padding:10px;">
                  <span class="card-title" style="font-size: 18px; font-weight: bold"><?php echo ucfirst(mb_strtolower($otraPublicacion['pub_titulo']))?></span>
                  <p style="font-size: 13px"><?php echo $contenidoSub?></p>
                </div>
                <div class="card-action right-align" style="padding:10px;" >
                  <a href="<?php echo 'pubID'.$otraPublicacion['pub_codigo']?>" style="text-align:right">Leer Poema</a>
                  <a href="<?php echo 'poeta-'.base64_encode($contenido['poet_codigo'])?>" style="text-align:right">Ver mas Poemas</a>
                </div>
              </div>
            </div>
          </div>

          </div>

          <div class="col s12">
            <h2 style="text-transform:initial">Recomendados</h2>
             <ul class="collection featured-poem">
            <?php foreach ($publicaciones->recomendados($_GET['pid']) as $row) { ?>
              <li class="collection-item">
                <a href="<?php echo 'pubID'.$row["pub_codigo"]?>">
                 <span class="title"><b><?php echo ucfirst(mb_strtolower($row["pub_titulo"])); ?></b></span><br>
                 <span><em>Autor: <?php echo ucfirst(mb_strtolower($row["poet_nick"])); ?> </em></span>
               </a>
              </li>
            <?php } ?>
          </ul>
          </div>
      </div>


    </div>
  </div>
</div>

<?php }elseif($contenido['pub_categoria'] == 'Noticia'){ ?>

<!-- VISTA DETALLE NOTICIA  -->

<div class="container wrap detail-poem">
  <div class="row">
    <div class="col l7">
      <?php
      if(isset($contenido['pub_imgPortada'])){ ?>
      <div class="row">
        <div class="col l12">
          <img src="cloud/views/assets/images/portadasPoemas/<?php echo $contenido['pub_imgPortada'] ?>" alt="<?php echo $contenido['pub_titulo']; ?>">
        </div>
      </div>
      <?php  } ?>

      <article class="row">
        <div id="title"><h1><?php echo $contenido["pub_titulo"]; ?></h1></div>
        <div id="postDate"><em>Publicado el <?php echo $publicaciones->fechaesp($contenido['pub_fechaPublicacion']); ?> </em></div>
        <div id="content"><?php echo strip_tags($contenido["pub_contenido"], '<p><br>'); ?></div>
        <div id="tags">
          <ul>
          <?php
            foreach ($categorias->categoriabyId($contenido['catePub_codigo']) as $key => $value) {
              echo '<li   class="chip teal lighten-5">'.$value["catePub_nombre"].'</li>';
            }
          ?>
          </ul>
        </div>
      </article>

      <section id="comments" class="row">
        <div class="center-align"><em>- Para realizar comentarios debes iniciar sesión con tu cuenta de InkSide -</em></div><br>

        <?php if(count($comentarios)>0){ ?>

        <div class="col l6"><h5>Comentarios</h5></div>
        <div class="col l6 right-align"><h6><?php echo count($comentarios); ?> Comentarios</h6></div>

        <div class="row">
        <div class="col s12">

          <?php
            foreach ($comentarios as $comentario) {

                if($comentario['pdesc_avatar']=='') {
                  $delimitador = explode("/",$comentario['poet_foto']);
                  if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
                    $avatar_comment = $comentario['poet_foto'];
                  }else{
                    $avatar_comment = "cloud/".$comentario['poet_foto'];
                  }
                }else{
                  $avatar_comment = 'cloud/'.$comentario['pdesc_avatar'];
                }

          ?>

          <div class="card grey lighten-3 z-depth-0">
            <div class="card-content ">
              <div class="card-title">
                <div id="author-comment" class="col s12">
                  <img src="<?php echo $avatar_comment?>" class="circle">
                   <p><span><?php echo $comentario["poet_nick"]?></span><em>Comentado el <?php echo $comentario["com_fecha"]?></em></p>
                </div>
              </div>

              <p id="article-comment"><?php echo $comentario["com_comentario"]; ?></p>
            </div>
            <!-- <div class="card-action">
              <a href="#">This is a link</a>
              <a href="#">This is a link</a>
            </div> -->
          </div>

          <?php } ?>

        </div>
      </div>
      <?php }else{ ?>
      <div class="col l12 center-align"><h5>Esta noticia aún no tiene comentarios</h5></div>
      <?php } ?>

      </section>
    </div>

    <div id="aboutPoet" class="col l4 right">
      <div class="row">
          <div class="col s12">
            <h2>Otras Noticias</h2>
             <ul class="collection featured-poem">
            <?php foreach ($publicaciones->otrasNoticias($_GET['pid']) as $row) { ?>
              <li class="collection-item">
                <a href="<?php echo 'pubID'.$row["pub_codigo"]?>">
                 <span class="title"><b><?php echo ucfirst(mb_strtolower($row["pub_titulo"])); ?></b></span><br>
                 <span><em>Fecha: <?php echo ucfirst(mb_strtolower($row["pub_fechaPublicacion"])); ?> </em></span>
                 <p><?php

                 $texto = strip_tags(ucfirst(mb_strtolower($row["pub_contenido"])));
                 $largor = 50;
                 $puntos = '...';

                 $palabras = explode(' ', $texto);
                 if (count($palabras) > $largor){
                    echo implode(' ', array_slice($palabras, 0, $largor)) ." ". $puntos;
                  }else{
                    echo $texto;
                  }
                  ?></p>
               </a>
              </li>
            <?php } ?>
          </ul>
          </div>
      </div>


    </div>
  </div>
</div>

<?php }else{ ?>

<!-- VISTA  EVENTO -->


<div class="container wrap detail-poem">
  <div class="row">
    <div class="col l7">
      <?php
      if(isset($contenido['pub_imgPortada'])){ ?>
      <div class="row">
        <div class="col l12">
          <img src="cloud/views/assets/images/portadasPoemas/<?php echo $contenido['pub_imgPortada'] ?>" alt="<?php echo $contenido['pub_titulo']; ?>">
        </div>
      </div>
      <?php  } ?>

      <article class="row">
        <div id="title"><h1><?php echo $contenido["pub_titulo"]; ?></h1></div>
        <div id="postDate"><em>Publicado el <?php echo $publicaciones->fechaesp($contenido['pub_fechaPublicacion']); ?> </em></div>
        <div id="content"><?php echo strip_tags($contenido["pub_contenido"], '<p><br>'); ?></div>
        <div id="tags">
          <ul>
          <?php
            foreach ($categorias->categoriabyId($contenido['catePub_codigo']) as $key => $value) {
              echo '<li   class="chip teal lighten-5">'.$value["catePub_nombre"].'</li>';
            }
          ?>
          </ul>
        </div>
      </article>

      <section id="comments" class="row">
        <div class="center-align"><em>- Para realizar comentarios debes iniciar sesión con tu cuenta de InkSide -</em></div><br>

        <?php if(count($comentarios)>0){ ?>

        <div class="col l6"><h5>Comentarios</h5></div>
        <div class="col l6 right-align"><h6><?php echo count($comentarios); ?> Comentarios</h6></div>

        <div class="row">
        <div class="col s12">

          <?php
            foreach ($comentarios as $comentario) {

                if($comentario['pdesc_avatar']=='') {
                  $delimitador = explode("/",$comentario['poet_foto']);
                  if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
                    $avatar_comment = $comentario['poet_foto'];
                  }else{
                    $avatar_comment = "cloud/".$comentario['poet_foto'];
                  }
                }else{
                  $avatar_comment = 'cloud/'.$comentario['pdesc_avatar'];
                }

          ?>

          <div class="card grey lighten-3 z-depth-0">
            <div class="card-content ">
              <div class="card-title">
                <div id="author-comment" class="col s12">
                  <img src="<?php echo $avatar_comment?>" class="circle">
                   <p><span><?php echo $comentario["poet_nick"]?></span><em>Comentado el <?php echo $comentario["com_fecha"]?></em></p>
                </div>
              </div>

              <p id="article-comment"><?php echo $comentario["com_comentario"]; ?></p>
            </div>
            <!-- <div class="card-action">
              <a href="#">This is a link</a>
              <a href="#">This is a link</a>
            </div> -->
          </div>

          <?php } ?>

        </div>
      </div>
      <?php }else{ ?>
      <div class="col l12 center-align"><h5>Este evento aún no tiene comentarios</h5></div>
      <?php } ?>

      </section>
    </div>

    <div id="aboutPoet" class="col l4 right">
      <div class="row">
          <div class="col s12">
            <h2>Otros Eventos</h2>
             <ul class="collection featured-poem">
            <?php foreach ($publicaciones->otrosEventos($_GET['pid']) as $row) { ?>
              <li class="collection-item">
                <a href="<?php echo 'pubID'.$row["pub_codigo"]?>">
                 <span class="title"><b><?php echo ucfirst(mb_strtolower($row["pub_titulo"])); ?></b></span><br>
                 <span><em>Fecha: <?php echo ucfirst(mb_strtolower($row["pub_fechaPublicacion"])); ?> </em></span>
                 <p><?php

                 $texto = strip_tags(ucfirst(mb_strtolower($row["pub_contenido"])));
                 $largor = 50;
                 $puntos = '...';

                 $palabras = explode(' ', $texto);
                 if (count($palabras) > $largor){
                    echo implode(' ', array_slice($palabras, 0, $largor)) ." ". $puntos;
                  }else{
                    echo $texto;
                  }
                  ?></p>
               </a>
              </li>
            <?php } ?>
          </ul>
          </div>
      </div>


    </div>
  </div>
</div>





<?php } ?>


<!-- ESTRUCTURA DEDICATORIAS -->

<div id="modal1" class="modal" style="max-height: 100%;">
  <form id="frmDedicatoria" method="post">
  <div class="modal-content">
    <h4>Dedica este poema</h4>
    <p>Para dedicar el poema "<b><em><?php echo ucwords($contenido['pub_titulo'])  ?></em></b>" simplemente ingresa los datos del siguiente formulario</p>


      <div class="input-field col s12">
        <input autocomplete="off"  class="fieldBD" id="txt_pubcodigo" type="hidden"  name="data[0]" value="<?php echo $_GET["pid"]?>">
        <input autocomplete="off"  class="fieldBD" id="txt_pubnombre" type="hidden"  name="data[1]" value="<?php echo $contenido['pub_titulo'] ?>">
        <input autocomplete="off"  class="fieldBD" id="txt_nombre" type="text"  name="data[2]" placeholder="Tu Nombre" required>
      </div>

      <div class="input-field col s12">
        <input autocomplete="off"  class="fieldBD" id="txt_nombre_destino" type="text"  name="data[4]" placeholder="Nombre del destinatario" required>
      </div>

      <div class="input-field col s12">
        <input autocomplete="off"  class="fieldBD" id="txt_correo" type="email"  name="data[3]" placeholder="Correo del destinatario" required>
      </div>

  </div>
  <div class="modal-footer">
    <button id="enviarDedicatoria" class="waves-effect waves-light  btn primary-button z-depth-0 btn-icon">Enviar Dedicatoria</button>
  </div>  </form>
</div>


<!-- ESTRUCTURA MODAL SEGUIR POETA -->

<div id="modalFollow" class="modal" style="max-height: 100%;">
  <div class="modal-content">
    <h4>Registrate e inicia sesión en Inkside!</h4>
    <p>Lo sentimos, para seguir un poeta te invitamos a que te registres de forma gratuita en nuestra comunidad.</p>
  </div>
</div>
