<section id="pag_login">
<div class="row container">
  <div class="col m7">
      <h5>¿Por qué debería hacer parte de la comunidad Inkside poesía?</h5>
      <small>Inkside te ofrece lo que siempre has soñado de una verdadera comunidad poética...</small>
      <div class="row items-register">
        <div class="col m1"><i class="fa fa-globe light-green-text " aria-hidden="true"></i></div>
        <div clasS="col m11"><p><b>Comparte con el mundo entero </b> tus poemas, articulos, noticias y eventos relacionados con el arte poético y literario en general. <span class="blue-text">¡Todos querrán conocerlo</span> </p> </div>
        <div class="col m1"><i class="fa fa-heart red-text" aria-hidden="true"></i></div>
        <div clasS="col m11"><p><b>Escribe </b> tus comentarios, califica y agrega <b>tus favoritos, sigue a otros</b> miembros y aumenta tu popularidad con nuevos <b>seguidores, comunicate</b> con ellos, <b>mantente informado y participa</b>. <span class="blue-text">¡Comparte, lee y construye. Se parte de la primera comunidad de poetas y amantes de la poesia!.</span> </p> </div>
        <div class="col m1"><i class="fa fa-road orange-text" aria-hidden="true"></i></div>
        <div clasS="col m11"><p><b>Somos una verdadera comunidad,</b> autosostenible, independiente, respetuosa con la información de nuestros miembros y con más de <b>6 años de existencia</b> en internet, <b>¡y todo esto gracias a personas como tú!</b>. <span class="blue-text">Nuestra larga trayectoria y 3 libros publicados desde, y para nuestra comunidad; comprueban nuestro compromiso con la sociedad y el arte. Ayuda a inkside poesía a seguir vivo por muchos años más.</span></p> </div>
      </div>


  </div>
  <div class="col m4 offset-m1 white border-1" id="wrap-login">
    <form class="row" method="post" data-parsley-validate id="registroPoeta">
      <h6>Registrate gratis en Inkside</h6>
      <div class="input-field col s12">
        <i class="fa fa-user input-icon right"></i>
        <input id="txt_nombre" name="data[1]" type="text" required autocomplete="off">
        <label for="txt_nombre">Nombre</label>
      </div>

      <div class="input-field col s12">
        <i class="fa fa-user input-icon right"></i>
        <input id="txt_apellido" name="data[2]"  type="text" required autocomplete="off">
        <label for="txt_apellido">Apellido</label>
      </div>

      <div class="input-field col s12">
        <i class="fa fa-envelope input-icon right"></i>
        <input id="txt_email" name="data[3]" type="email" required autocomplete="off">
        <label for="txt_email">Tu dirección de correo electrónico</label>
      </div>

      <div class="input-field col s12">
        <i class="fa fa-lock input-icon right"></i>
        <input id="txt_clave" name="data[4]" type="password" required autocomplete="off" data-parsley-minlength="8">
        <label for="txt_clave">Cree una contraseña</label>
      </div>

      <div class="input-field col s12">
        <i class="fa fa-lock input-icon right"></i>
        <input id="txt_clave_confirm" type="password" required data-parsley-equalto="#txt_clave" autocomplete="off">
        <label for="txt_clave_confirm">Confirma tu contraseña</label>
      </div>

      <div class="input-field col m12" style="margin-bottom:20px">
        <button id="signup" style="width:100%" class="waves-effect waves-light btn right  light-blue lighten-1" >¡Si, regístrame!</button>
      </div>

       <div class="col s3"><hr></div>
       <div class="col s6 center">O a través de</div>
       <div class="col s3"><hr></div>

       <div class="col s12 center" style="margin-top:20px; font-size: 20px;">
           <a href="auth.php?p=facebook"><i class="fa fa-facebook-official"> </i></a>
           <a href="auth.php?p=twitter"><i class="fa fa-twitter"> </i></a>
       </div>


    </form>
  </div>
</div>
</section>
