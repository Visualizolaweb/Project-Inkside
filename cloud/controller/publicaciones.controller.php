<?php
 require_once 'model/publicaciones.model.php';
 require_once("controller/poemas.controller.php");


class PublicacionesController extends InitController{

  private $publicaciones;
  private $poemas;

  public function __CONSTRUCT(){
      $this->publicaciones = new PublicacionesModel();
      $this->poemas = new PoemasController();
  }

  public function misPublicaciones(){
      $publicaciones = $this->publicaciones->cargarMisPublicaciones($_SESSION["poeta"]["poet_codigo"]);
      return $publicaciones;
  }

  public function paginarPublicaciones(){
    $Publicaciones = $this->publicaciones->cargarPoemas();
    $num_total_registros = count($Publicaciones);

    $TAMANO_PAGINA = 4;

    $pagina = @$_GET["pagina"];
    if (!$pagina) {
       $inicio = 0;
       $pagina = 0;
    } else {
       $inicio = ($pagina - 1) * $TAMANO_PAGINA;
    }
      $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

       $poemasContent = $this->publicaciones->mostrarPoemas($inicio, $TAMANO_PAGINA);

       foreach ($poemasContent as $content) {
         $Content = $this->poemas->getSubString($content["pub_contenido"]);
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
               <img src="'.$content["poet_foto"].'" alt="author" data-pin-nopin="true">

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

       echo '<p><hr></p>
      <div style="width:100%; text-align:center;">';
      //si posicion es mayor o igual a 1 quiere decir que muestre la parte Primero y Anterior de la paginación
      if ($pagina >= 1) {
        $url = "index.php?c=views&a=poemas&pagina=0";
        echo "<a href=\"$url\">Primero</a>\n";
        //para que el preius no termine con valor 0
         $url = "index.php?c=views&a=poemas&pagina=" .($pagina-1);
        echo "<a href=\"$url\">Anterior</a>\n";
      }
      //sirve para expandir el prollecto para poder paginar de la manera (Primero Anterior | 0 | 1 | 2 | 3 | Siguiente Ultimo)
      /*for ($i = 0; $i < $pages; $i++) {
        $url = "pag_next.php?screen=" . $i;
        echo " | <a href=\"$url\">$i</a> | ";
      }*/

      //muestra total de resultados 1 de N
      echo '<strong>'.($pagina+1).' de '.$total_paginas.' </strong>';

      //si position es menor a el valor entre los parentesis muestra la parte (Siguiente Ultimo)
      if ($pagina < ($total_paginas-1)) {
        $url = "index.php?c=views&a=poemas&pagina=" . ($pagina+1);
        echo "<a href=\"$url\">Siguiente</a>\n";
        $url = "index.php?c=views&a=poemas&pagina=" . ($total_paginas-1);
        echo "<a href=\"$url\">Ultimo</a>\n";
      }
      echo '</div>';

      //  if ($total_paginas > 1) {
      //    $url = "index.php?c=views&a=poemas";
      //     if ($pagina != 1)
      //        echo '<a href="'.$url.'&pagina='.($pagina-1).'"></a>';
      //        for ($i=1;$i<=$total_paginas;$i++) {
      //           if ($pagina == $i)
      //              //si muestro el índice de la página actual, no coloco enlace
      //              echo $pagina;
      //           else
      //              //si el índice no corresponde con la página mostrada actualmente,
      //              //coloco el enlace para ir a esa página
      //              echo '  <a href="'.$url.'&pagina='.$i.'">'.$i.'</a>  ';
      //        }
      //        if ($pagina != $total_paginas)
      //           echo '<a href="'.$url.'&pagina='.($pagina+1).'"></a>';
      //  }
  }
}
?>
