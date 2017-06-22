<?php
session_start();
include '../vendor/autoload.php';

switch ($_GET["p"]){

  case 'facebook':
        $config = ['callback' => 'http://inksidepoesia.com/beta/cloud/auth.php?p=facebook','keys' => ['id' => '697119137130415', 'secret' => '18f0758b3f8db9514f6a063830cc46ac']];
        try {
            $adapter = new Hybridauth\Provider\Facebook( $config );
            $adapter->authenticate();
            $accessToken = $adapter->getAccessToken();
            $userProfile = $adapter->getUserProfile();

            $_SESSION["poeta"]["acc_social_id"]        = $userProfile->identifier;
            $_SESSION["poeta"]["poet_nombre"]          = $userProfile->firstName;
            $_SESSION["poeta"]["poet_apellido"]        = $userProfile->lastName;
            $_SESSION["poeta"]["poet_nick"]            = $userProfile->displayName;
            $_SESSION["poeta"]["poet_email"]           = $userProfile->email;
            $_SESSION["poeta"]["poet_foto"]            = $userProfile->photoURL;
            $_SESSION["poeta"]["poet_fecha_nac"]       = $userProfile->birthYear.'-'.$userProfile->birthMonth.'-'.$userProfile->birthDay;
            $_SESSION["poeta"]["poet_sexo"]            = $userProfile->gender;
            $_SESSION["poeta"]["poet_descripcion"]     = $userProfile->description;
            $_SESSION["poeta"]["acc_origen_conexion"]  = "Facebook";

            $adapter->disconnect();

            header("Location: registro-social");
          }catch( Exception $e ){
            echo $e->getMessage();
          }
  break;

  case 'twitter':
        $config = ['callback' => 'http://inksidepoesia.com/beta/cloud/auth.php?p=twitter','keys' => ['key' => 'f5rHQUr3JME44O64p8b3do3XW', 'secret' => 'L87hbt5TiMnUsAU77Ma100SVt2aUwDWzhi0CXWhPPKpBL1VVZ4']];
        try {
            $adapter = new Hybridauth\Provider\Twitter( $config );
            $adapter->authenticate();
            $accessToken = $adapter->getAccessToken();
            $userProfile = $adapter->getUserProfile();

            $_SESSION["poeta"]["acc_social_id"]        = $userProfile->identifier;
            $_SESSION["poeta"]["poet_nombre"]          = $userProfile->firstName;
            $_SESSION["poeta"]["poet_apellido"]        = $userProfile->lastName;
            $_SESSION["poeta"]["poet_nick"]            = $userProfile->displayName;
            $_SESSION["poeta"]["poet_email"]           = $userProfile->email;
            $_SESSION["poeta"]["poet_foto"]            = $userProfile->photoURL;
            $_SESSION["poeta"]["poet_fecha_nac"]       = $userProfile->birthYear.'-'.$userProfile->birthMonth.'-'.$userProfile->birthDay;
            $_SESSION["poeta"]["poet_sexo"]            = $userProfile->gender;
            $_SESSION["poeta"]["poet_descripcion"]     = $userProfile->description;
            $_SESSION["poeta"]["acc_origen_conexion"]  = "Twitter";

            $adapter->disconnect();

            header("Location: registro-social");
          }catch( Exception $e ){
            echo $e->getMessage();
          }
  break;

  default:
      header("Location: registro");
  break;
}

?>
