<?php
 require_once 'model/publicaciones.model.php';

 require_once("controller/poemas.controller.php");
 require_once("controller/poetas.controller.php");
 require_once("controller/comentarios.controller.php");
 require_once("controller/likes.controller.php");

class PublicacionesController extends InitController{

  private $publicaciones;
  private $poemas;
  private $poetas;
  private $likes;
  private $comentarios;

  public function __CONSTRUCT(){
      $this->publicaciones = new PublicacionesModel();
      $this->poemas = new PoemasController();
      $this->poetas = new PoetasController();
      $this->likes = new likesController();
      $this->comentarios = new ComentariosController();
  }

  public function misPublicaciones(){
      $publicaciones = $this->publicaciones->cargarMisPublicaciones($_SESSION["poeta"]["poet_codigo"]);
      return $publicaciones;
  }

  public function paginarPublicaciones($tipoArticulo){

    $Publicaciones = $this->publicaciones->cargarPoemas($tipoArticulo);
    $num_total_registros = count($Publicaciones);

    $TAMANO_PAGINA = 8;

    $pagina = @$_GET["pagina"];
    if (!$pagina) {
       $inicio = 0;
       $pagina = 1;
    } else {
       $inicio = ($pagina - 1) * $TAMANO_PAGINA;
    }
      $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

       $poemasContent = $this->publicaciones->mostrarPoemas($inicio, $TAMANO_PAGINA, $tipoArticulo);

       if(count($poemasContent)>0){
       foreach ($poemasContent as $content) {
         $totalLikes = $this->likes->likes($content['pub_codigo']);
         $allLikes = count($totalLikes);

         $totalcomentarios = $this->comentarios->comentarios($content['pub_codigo']);
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

         if(@$content['pdesc_avatar']!=''){
           $avatarPublic = $content['pdesc_avatar'];
         }else{
           $avatarPublic = $content['poet_foto'];
         }

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
             <a href="javascript:void(0)" onClick="addLikes(\''.$content["pub_codigo"].'\',\''.$accion.'\',\''.$allLikes.'\')"><li><i class="fa fa-heart"></i></li></a>
             <a href="pubID'.$content["pub_codigo"].'"><li><i class="fa fa-comments"></i></li></a>';

             if($tipoArticulo == 'Poema'){
              echo '<a href="javascript:void(0)" onClick="dedicaPoema(\''.$content["pub_codigo"].'\',\''.$_SESSION["poeta"]["poet_codigo"].'\')"><li><i class="fa fa-paper-plane"></i></li></a>';
             }

          echo '</ul>
           </div>

            <div class="post__author author vcard inline-items">
               <img src="'.$avatarPublic.'" alt="author" data-pin-nopin="true">

               <div class="author-date">
                 <a class="h6 post__author-name fn" href="poeta-'.base64_encode($content["poet_codigo"]).'">'.$content["poet_nick"].'</a>
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
                $this->likes->likesConAvatar($content['pub_codigo']);
                 echo '</div>
                 <div class="comments col l3 center">
                   <a href="pubID'.$content["pub_codigo"].'" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="Este poema cuenta con '.$allCoementarios.' comentarios"><i class="fa fa-comments"></i> '.$allCoementarios.'</a>
                   &nbsp;';
                   if($tipoArticulo == 'Poema'){
                   echo '<a href="javascript:void(0)" onClick="dedicaPoema(\''.$content["pub_codigo"].'\',\''.$_SESSION["poeta"]["poet_codigo"].'\')" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="A '.$content["pub_dedicatorias"].' personas se les ha dedicado este poema"><i class="fa fa-bullhorn"></i> '.$content["pub_dedicatorias"].'</a>';
                    }
                 echo '</div>
             </div>
           </div>
         </div>';
       }
     }else{
       echo "<div class='center'>Aun no hay publicaciones de esta categoría</div>";
     }
       echo '<p><hr></p>
      <div style="width:100%; text-align:center;">';
      //si posicion es mayor o igual a 1 quiere decir que muestre la parte Primero y Anterior de la paginación
      if ($pagina >= 1) {
        $url = "index.php?c=views&t=$tipoArticulo&a=poemas&pagina=0";
        echo "<a href=\"$url\">Primero</a>\n";
        //para que el preius no termine con valor 0
         $url = "index.php?c=views&t=$tipoArticulo&a=poemas&pagina=" .($pagina-1);
        echo "<a href=\"$url\">Anterior</a>\n";
      }


      //muestra total de resultados 1 de N
      echo '<strong>'.($pagina).' de '.$total_paginas.' </strong>';

      //si position es menor a el valor entre los parentesis muestra la parte (Siguiente Ultimo)
      if ($pagina < ($total_paginas-1)) {
        $url = "index.php?c=views&a=poemas&t=$tipoArticulo&pagina=" . ($pagina+1);
        echo "<a href=\"$url\">Siguiente</a>\n";
        $url = "index.php?c=views&a=poemas&t=$tipoArticulo&pagina=" . ($total_paginas-1);
        echo "<a href=\"$url\">Ultimo</a>\n";
      }
      echo '</div>';

  }

  public function cargarPublicacionbyID($pub_codigo){
      $publicaciones = $this->publicaciones->cargabyId($pub_codigo);
      return $publicaciones;
  }

  public function guardarHits($pub_codigo){
      $this->publicaciones->guardarHit($pub_codigo);
  }

  public function guardarDedicatoria($pub_codigo){
      $this->publicaciones->dedicatoria($pub_codigo);
  }

  public function misMasleidos($poet_codigo){
      return $this->publicaciones->masLeidos($poet_codigo);
  }

  public function apruebo(){
      $pub_codigo = $_GET["pid"];
      $revision = "Aprobado";
      $estado   = "Publicado";
      $this->publicaciones->actualizoestado($pub_codigo,$revision, $estado );

              header("Location: mis-publicaciones");
  }

  public function rechazo(){
      $pub_codigo = $_GET["pid"];
      $revision = "Rechazado";
      $estado   = "Borrador";
      $this->publicaciones->actualizoestado($pub_codigo,$revision, $estado );

              header("Location: mis-publicaciones");
  }

    public function elimino(){
        $codigo = $_GET['pid'];
        $this->publicaciones->eliminoPublicacion($codigo);

        header("Location: mis-publicaciones");
    }

  public function Buscador(){
    $buscar = $_POST['busqueda'];
    $buscarPublicaciones = $this->publicaciones->buscarPublicacion($buscar);
    // return array($poetas, $poemas);
    return $buscarPublicaciones;
  }

  public function cuentaPoemasporPoeta($poet_codigo){
    $limit = "";
    $result = $this->publicaciones->cargarPoemasporPoeta($limit, $poet_codigo);
    return count($result);
  }

  public function poemasporPoeta($desde, $hasta, $poet_codigo){
    if(!isset($hasta)){
      $limit = "";
    }else{
      $limit = "LIMIT ".$desde." , ".$hasta;
    }
    $result = $this->publicaciones->cargarPoemasporPoeta($limit, $poet_codigo);
    return $result;
  }

  public function getSubString($string, $length=NULL){
    if ($length == NULL)
        $length = 250;
    $stringDisplay = substr(strip_tags($string), 0, $length);
    if (strlen(strip_tags($string)) > $length)
        $stringDisplay .= ' ...';
    return $stringDisplay;



 }

 function fechaesp($date) {
    $dia = explode("-", $date, 3);
    $year = $dia[0];
    $month = (string)(int)$dia[1];
    $day = (string)(int)$dia[2];

    $dias = array("Domingo","Lunes","Martes","Miércoles" ,"Jueves","Viernes","Sábado");
    $tomadia = $dias[intval((date("w",mktime(0,0,0,$month,$day,$year))))];

    $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    return $tomadia.", ".$day." de ".$meses[$month]." de ".$year;
}

}
?>
