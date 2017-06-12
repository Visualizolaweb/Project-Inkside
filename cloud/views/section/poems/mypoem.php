<?php
  require_once("controller/poemas.controller.php");
  $poemas = new PoemasController();
  $poemasContent = $poemas->poemas();
?>
<section id="wrap-container">
  <div class="row container-fluid wrap-panes">
      <div class="col l3">

        <!-- Widget Poetas Sugeridos -->
        <div class="panel">
          <div class="panel-title">Poetas Sugeridos</div>
          <ul class="collection">
              <li class="collection-item avatar">
                <img src="views/assets/images/perfil/avatar38-sm.jpg" alt="" class="circle">
                <span class="title">Nicolás Ramírez</span>
                <p>Medellín, CO.</p>
                <a href="#!" class="secondary-content add-poet"><i class="fa fa-heart-o"></i></a>
              </li>

              <li class="collection-item avatar">
                <img src="views/assets/images/perfil/avatar39-sm.jpg" alt="" class="circle">
                <span class="title">Jesus Daniel Toro</span>
                <p>Medellín, CO.</p>
                <a href="#!" class="secondary-content add-poet"><i class="fa fa-heart-o"></i></a>
              </li>

              <li class="collection-item avatar">
                <img src="views/assets/images/perfil/avatar40-sm.jpg" alt="" class="circle">
                <span class="title">Mario A. Garcia</span>
                <p>Medellín, CO.</p>
                <a href="#!" class="secondary-content add-poet"><i class="fa fa-heart-o"></i></a>
              </li>
          </ul>
        </div>

        <!-- Widget - Tu publicaciones mas vistas -->
        <div class="panel">
          <div class="panel-title">Tus publicaciones más vistas</div>
          <div class="collection">
              <a href="#!" class="collection-item"><span class="new badge green" data-badge-caption="Vistas">18</span>Besos Con sonrisa</a>
              <a href="#!" class="collection-item"><span class="new badge" data-badge-caption="Vistas">4</span>Emanuel Luna</a>
              <a href="#!" class="collection-item"><span class="new badge blue-grey lighten-5 black-text"  data-badge-caption="Vista">1</span>Preguntas de Dos Amantes</a>
            </div>
        </div>
      </div>

      <div class="col l6">

        <!-- Widget - Bienvenido -->
        <div class="panel message">
          <div class="icon-message cyan accent-3"><i class="fa fa-star"></i></div>
          <p>Aquí podrás ver los poemas sugeridos según tus gustosr</p>
        </div>

        <!-- Widget - Poemas -->

        <?php
          foreach ($poemasContent as $content) {
            $Content = $poemas->getSubString($content["pub_contenido"]);
              echo '<div class="panel poem">
                <div class="control-button">
                  <ul>
                    <a href="editar-poema"><li><i class="fa fa-pencil-square-o"></i></li></a>
                    <a href="!#"><li><i class="fa fa-times"></i></li></a>
                  </ul>
                </div>

                 <div class="post__author author vcard inline-items">
      							<img src="views/assets/images/perfil/avatar46-sm.jpg" alt="author" data-pin-nopin="true">

      							<div class="author-date">
      								<a class="h6 post__author-name fn" href="#">'.$content["poet_nick"].'</a>
      								<div class="post__date">
      									<time class="published" datetime="2017-03-24T18:18">
      									   Publicado hace 36 min.
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
              </div>';
          }
        ?>

        <!-- POEMA NUMERO 2 -->
        <!-- <div class="panel poem">
          <div class="control-button">
            <ul>
              <a href="!#"><li><i class="fa fa-heart"></i></li></a>
              <a href="!#"><li><i class="fa fa-comments"></i></li></a>
              <a href="!#"><li><i class="fa fa-bullhorn"></i></li></a>
            </ul>
          </div>

           <div class="post__author author vcard inline-items">
							<img src="views/assets/images/perfil/avatar44-sm.jpg" alt="author" data-pin-nopin="true">

							<div class="author-date">
								<a class="h6 post__author-name fn" href="#">Natalia</a>
								<div class="post__date">
									<time class="published" datetime="2017-03-24T18:18">
									   Publicado el 20 de Mayo
									</time>
								</div>
							</div>
  				</div>

          <div class="post__content">
            <h3>Recuperando el tiempo</h3>
            <img src="views/assets/images/si5.JPG" class="responsive-img"/>
            <p>Voy ahogando el miedo en el rio de mis sueños
            limpiando las heridas, recuperando el tiempo... </p>

            <p>y no es ningún secreto que el amor me daba miedo
            pero encontré en tus ojos el valor que le faltaba al corazón </p>

            <p>Te ofrezco mis recuerdos, te regalo mis silencios
            porque al despertar contigo
            todo tiene sentido </p>

            <p>voy rompiendo esquemas, defendiendo mis ideas
            Confiando en el camino que me dicta el corazón
            voy con la certeza que al final valdrá la pena
            ángel del destino quiero estar contigo </p>
            <div class="more-detail right-align "><a href="" class="teal-text"><i class="fa fa-circle"></i> <i class="fa fa-circle"></i> <i class="fa fa-circle"></i></a></div>
          </div>

          <div class="post__aditional row">
            <div class="favorite col l2">
              <a href="!#" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="Se el primero en darle me gusta al poema"><i class="fa fa-heart-o"></i> 0</a>
            </div>

            <div class="user-likes col l7">
              <div class="pic-profiles">
              <a href="!#">
                <ul style="width: 85px;">
                  <li><img src="views/assets/images/perfil/avatar60-sm.jpg" class="thum-poem"/></li>
                  <li><img src="views/assets/images/perfil/avatar39-sm.jpg" class="thum-poem"/></li>
                  <li><img src="views/assets/images/perfil/avatar38-sm.jpg" class="thum-poem"/></li>
                </ul>
              </a>
              </div>
              <div class="poets-like">A 3 personas les ha gustado este poema</div>
            </div>
            <div class="comments col l3 center">
              <a href="!#" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="Este poema cuenta con 1 comentario"><i class="fa fa-comments"></i> 1</a>
              &nbsp;
              <a href="!#" class="tooltipped blue-grey-text" data-position="top" data-delay="50" data-tooltip="Se el primero en dedicar este poema"><i class="fa fa-bullhorn"></i> 0</a>
            </div>
          </div>
        </div> -->
      </div>

      <div class="col l3">
        <div class="poem-create">
          <div>
            <i class="fa fa-pencil"></i>
            <h4>Crea tu poema y expresa tus pensamientos</h4>
            <a class="btn-link">Crea tu poema</a>
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
