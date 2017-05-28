<?php

$config = dirname(__FILE__) . 'dist/hybridauth/config.php';
require_once( "hybridauth/Hybrid/Auth.php" );

try {
  // se inicializa la libreria
  $hybridauth = new Hybrid_Auth($config);

  // obtenemos el proveedor por parámetros (Google, Twitter, etc)
  $provider_name = $_REQUEST["provider"];

  // autenticamos a la persona
  $twitter = $hybridauth->authenticate($provider_name);

   // obtenemos la información (perfil) del usuario
  $user_profile = $twitter->getUserProfile();

 // mensaje de saludo al usuario con su informacion
 echo "Hi there! " . $user_profile->displayName . " " . $user_profile->email . " " . $user_profile->birthDay;
} catch (Exception $e) {
  echo "Ooophs, we got an error: " . $e->getMessage();
  die();
}
?>
