<?php
   require_once 'website/controller/poetas.controller.php';
   $poetas = new PoetasController();
?>
<div class="container">
  <?php
  $poetasComunidad = $poetas->PoestasdelaComunidad();
  foreach ($poetasComunidad as $row) {
    echo '<figure class="snip1559">
          <div class="profile-image"><img src="cloud/'.$row['poet_foto'].'" alt="'.$row['poet_nick'].'" /></div>
          <figcaption>
            <h3>'.$row['poet_nick'].'</h3>
            <p>'.$row['poet_descripcion'].'</p>
          </figcaption>
        </figure>';
  }
  ?>
  <!-- <figure class="snip1559">
    <div class="profile-image"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample2.jpg" alt="profile-sample2" /></div>
    <figcaption>
      <h3>Darina Arenas</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
      <button class="center waves-effect waves-light btn amber accent-3 z-depth-0 btn-icon"><i class="fa fa-plus icon-button orange"></i>Seguir al poeta</button>
    </figcaption>
  </figure> -->
</div>
