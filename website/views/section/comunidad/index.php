<?php
   require_once 'website/controller/poetas.controller.php';
   $poetas = new PoetasController();

   require_once 'website/controller/publicaciones.controller.php';
   $publicaciones = new PublicacionesController();

  //  INICIO PAGINACION

    $totalPoetas =  $poetas->cuentaPoetas();
    $cantRegistros = 30;

    $pagina = @$_GET["pagina"];
    if (!$pagina) {
       $inicio = 0;
       $pagina = 1;
    } else {
       $inicio = ($pagina - 1) * $cantRegistros;
    }

    $total_paginas = ceil($totalPoetas / $cantRegistros);

    $poetasComunidad = $poetas->PoestasdelaComunidad($inicio,$cantRegistros);
?>
<section class="sec-publicaciones ">
<div class="container wrap">
  <h1 style="margin-bottom:30px;">Comunidad de escritores InkSide</h1>
  <section class="pinBoot">
  <?php

  foreach ($poetasComunidad as $row) {
     $contenido = $publicaciones->getSubString($row['pdesc_acerca']);

     if ($row['pdesc_avatar']=='') {
       $delimitador = explode("/",$row['poet_foto']);
       if(($delimitador[0] == 'https:') OR ($delimitador[0] == 'http:')){
         $avatar = $row['poet_foto'];
       }else{
         $avatar = "cloud/".$row['poet_foto'];
       }
     }else{
       if($row['poet_foto'] != 'views/assets/images/perfil/img_default.png'){
         $avatar = "cloud/".$row['poet_foto'];
       }else{
         $avatar = 'cloud/'.$row['pdesc_avatar'];
       }
     }
     
    echo '<article class="community-panel">
          <div class="profile-image circle"><img src="'.$avatar.'" alt="'.$row['poet_nick'].'" /></div>
            <h3>'.$row['poet_nick'].'</h3>
            <div class="center-align white-text"><a href="poeta-'.base64_encode($row['poet_codigo']).'" type="button" class="center waves-effect waves-light btn indigo darken-4 z-depth-0 btn-icon"><i class="fa fa-newspaper-o icon-button orange"></i>Ver Poemas</a></div>
            <p>'.$contenido.'</p>

        </article>';

  }

  ?>
</div>
</div>
</section>

<section class="row">
<?php

  echo '
 <div style="width:100%; text-align:center;">';
 //si posicion es mayor o igual a 1 quiere decir que muestre la parte Primero y Anterior de la paginación
 if ($pagina >= 1) {
   $url = "index.php?c=views&a=comunidad&pagina=0";
   echo "<a href=\"$url\">Primero</a>\n";
   //para que el preius no termine con valor 0
    $url = "index.php?c=views&a=comunidad&pagina=" .($pagina-1);
   echo "<a href=\"$url\">Anterior</a>\n";
 }

 echo '<strong> Página '.($pagina).' de '.$total_paginas.' </strong>';

 //si position es menor a el valor entre los parentesis muestra la parte (Siguiente Ultimo)
 if ($pagina < ($total_paginas-1)) {

   $url = "index.php?c=views&a=comunidad&pagina=" . ($pagina+1);
   echo "<a href=\"$url\">Siguiente</a>\n";
   $url = "index.php?c=views&a=comunidad&pagina=" . ($total_paginas-1);
   echo "<a href=\"$url\">Ultimo</a>\n";
 }
 echo '</div>';


 ?>
</section>
