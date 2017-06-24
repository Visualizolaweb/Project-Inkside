<?php
  require_once 'website/controller/publicaciones.controller.php';
  require_once 'website/controller/categorias.controller.php';

  $publicaciones = new PublicacionesController();
  $categorias    = new CategoriasController();

  $contenido = $publicaciones->cargarPublicacionbyID();
  $otraPublicacion = $publicaciones->otrasPublicaciones($contenido['poet_codigo'],$_GET['pid']);

  $contenidoSub = $publicaciones->getSubString($otraPublicacion['pub_contenido']);

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

      <div id="social-detail" class="row">
        <div class="col l3"><i class="fa fa-eye"></i>559</div>
        <div class="col l3 right right-align">
          <i class="fa fa-comments-o"></i>3&nbsp;
          <i class="fa fa-heart red-text"></i>3
        </div>
      </div>
      <div id="dedicate" class="right">
        <a href="" class="waves-effect waves-light blue-grey lighten-4 btn z-depth-0 btn-icon"><i class="fa fa-paper-plane icon-button  pink accent-3"></i>Dedica este poema</a>
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
        <div class="col l6"><h5>Comentarios</h5></div>
        <div class="col l6 right-align"><h6>10 Comentarios</h6></div>

        <div class="row">
        <div class="col s12">
          <div class="card grey lighten-3 z-depth-0">
            <div class="card-content ">
              <span class="card-title">Card Title</span>
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <!-- <div class="card-action">
              <a href="#">This is a link</a>
              <a href="#">This is a link</a>
            </div> -->
          </div>
        </div>
      </div>
      </section>
    </div>

    <div class="col l4 right">
      <div class="row">
        <div class="col s12">
          <h2>Sobre el Autor</h2>
        </div>

        <div class="col s8 offset-s2">
          <img src="<?php echo $avatar?>" class="circle">
        </div>

        <div class="col s12 center-align">
          <h5><?php echo ucwords($poeta['poet_nick'])?></h5>
          <?php if(isset($poeta['pdesc_acerca'])){
             echo "<p style='text-align:justify'>".$poeta['pdesc_acerca']."</p>";
          }?>

          <button id="followPoet" class="center waves-effect waves-light btn amber accent-3 z-depth-0 btn-icon"><i class="fa fa-plus icon-button orange"></i>Seguir al poeta</button>
          <br><br><em style="display:block">- Poema del autor sugerido -</em>

          <div class="row">
            <div class="col s12">
              <div class="card blue-grey darken-1">
                <div class="card-content white-text" style="padding:10px;">
                  <span class="card-title" style="font-size: 18px; font-weight: bold"><?php echo ucfirst(mb_strtolower($otraPublicacion['pub_titulo']))?></span>
                  <p style="font-size: 13px"><?php echo $contenidoSub?></p>
                </div>
                <div class="card-action right-align" style="padding:10px;" >
                  <a href="<?php echo 'pubID'.$otraPublicacion['pub_codigo']?>" style="text-align:right">Leer Poema</a>
                  <a href="<?php echo 'pubID'.$otraPublicacion['pub_codigo']?>" style="text-align:right">Ver mas Poemas</a>
                </div>
              </div>
            </div>
          </div>

          </div>

          <div class="col s12">
            <h2>Recomendados</h2>
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
