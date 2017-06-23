<?php
  require_once 'website/controller/publicaciones.controller.php';
  $publicaciones = new PublicacionesController();
  $contenido = $publicaciones->cargarPublicacionbyID();
  $otraPublicacion = $publicaciones->otrasPublicaciones($contenido['poet_codigo']);

  $contenidoSub = $publicaciones->getSubString($otraPublicacion['pub_contenido']);


  require_once 'website/controller/poetas.controller.php';
  $poetas = new PoetasController();
  $poeta = $poetas->buscarDatoPoeta($contenido['poet_codigo']);


  if ($poeta['pdesc_avatar']=='') {
    $avatar = $poeta['poet_foto'];
  }else{
    $avatar = $poeta['pdesc_avatar'];
  }

?>
<div class="container wrap">
  <div class="row">
    <div class="col m9">
      <div class="fechaPublicacion" style="border-top: 1px solid #ddd; padding-top:5px; width:100%;">Publicada el <?php echo $contenido['pub_fechaPublicacion'];?></div>
      <h1 style="color: #208d8f; font-size: 32px; margin-top: 8px; margin-bottom: 8px"><?php echo $contenido['pub_titulo'];?></h1>

      <div class="compartir row" style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 17px 0;">
        <div class="col m6"><button class="waves-effect waves-light btn primary-button z-depth-0 btn-icon"><i class="fa fa-users icon-button"></i>iniciar sesión Para dedicar</button></div>
        <!-- <div class="col m6">compartir en <a href="" class="waves-effect waves-light btn z-depth-0 btn-icon"><i class="fa fa-facebook icon-button"></i>Facebook</a></div> -->
      </div>

      <article style="text-align:justify">
          <?php echo $contenido['pub_contenido'];?>
      </article>

      <div class="tags" style="border-bottom:1px solid #ddd; padding-bottom:10px; margin-bottom:10px;">
        <span>Esta publicación habla de</span>
        <ul>
          <li style="display:inline; padding:5px 8px; color: white" class="pink accent-3"><?php echo $contenido['catePub_nombre'];?></li>
          <!-- <li style="display:inline; padding:5px 8px; color: white" class=" lime accent-4">Felicidad</li>
          <li style="display:inline; padding:5px 8px; color: white" class="cyan darken-1">Amigos</li>
          <li style="display:inline; padding:5px 8px; color: white" class="grey">Desamor</li>
          <li style="display:inline; padding:5px 8px; color: white" class="purple accent-3">Vida</li> -->
        </ul>
      </div>

      <!-- <section class="comentarios">
        <h3  style="font-size:15px">Realiza un comentario</h3>
        <textarea style="height:100px"></textarea>
        <button class="right waves-effect waves-light btn primary-button z-depth-0 btn-icon"><i class="fa fa-comment icon-button"></i>Realizar Comentario</button>
      </section> -->
    </div>

    <div class="col m3">
      <div class="autor">
        <div class="row">
          <div class="col m12 center">
            <img width="100" src="cloud/<?php echo $avatar?>" class="circle">
            <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 0;"><?php echo $poeta['poet_nick']?></h2>
            <p><?php echo $poeta['pdesc_acerca']?></p>
            <!-- <button class="center waves-effect waves-light btn amber accent-3 z-depth-0 btn-icon"><i class="fa fa-plus icon-button orange"></i>Seguir al poeta</button> -->
          </div>
           <div class="col m12">
             <h3  style="font-size:15px" class="center">Otras publicaciones del autor</h3>

             <div class="row">
               <div class="col s12">
                 <div class="card blue-grey darken-1">
                   <div class="card-content white-text" style="padding:10px;">
                     <span class="card-title" style="font-size: 18px; font-weight: bold"><?php echo $otraPublicacion['pub_titulo']?></span>
                     <p style="font-size: 13px"><?php echo $contenidoSub?></p>
                   </div>
                   <div class="card-action" style="padding:10px;">
                     <a href="<?php echo 'pubID'.$otraPublicacion['pub_codigo']?>" style="text-align:right">Leer Poema</a>
                   </div>
                 </div>
               </div>
             </div>


           </div>
        </div>
      </div>
    </div>
  </div>
</div>
