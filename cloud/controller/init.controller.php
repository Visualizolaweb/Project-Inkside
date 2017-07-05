<?php
  require "../vendor/phpmailer/phpmailer/PHPMailerAutoload.php";

  class InitController{

    public function __CONSTRUCT(){
        date_default_timezone_set('America/Bogota');
    }

    public function generarToken($length){
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$%/';
      $charactersLength = strlen($characters);
      $randomAlpha = '';

      for ($i = 0; $i < $length; $i++) {
           $randomAlpha .= $characters[rand(0, $charactersLength - 1)];
      }

      return "$2T$9".$randomAlpha;
    }

    public function randomCodigo($length){
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomCode = '';

      for ($i = 0; $i < $length; $i++) {
           $randomCode .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomCode;
    }

    public function generarPk($pref,$groups,$lenght){
      $groupCode = $this->randomCodigo($lenght)."-";

      for ($i=1; $i < $groups; $i++) {

          $groupCode .= $this->randomCodigo($lenght);
          if($i < ($groups - 1)){$groupCode .= "-";}
      }
      return $pref.":".$groupCode;
    }


      public function sendMailPassword($data){

        $mail = new PHPMailer;
        $mail->Host = "smtpout.secureserver.net";
        $mail->Port = 25;
        $mail->SMTPAuth = false;
        $mail->setFrom('inksidepoesia@organicgrowerscolombia.com', 'Inkside Poesia');
        $mail->addAddress($data[0], $data[1]);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $nombre_poeta = explode(" ", $data[1]);
        $mail->Subject = "Recupera tu cuenta";
        include 'views/section/tmpMailer/recuperaCuenta.php';

        if (!$mail->send()) {
            $message = array(0, "Mailer Error: " . $mail->ErrorInfo);
        } else {
            $message = array(1, "El registro ha sido exitoso, por favor verifique el correo electronico para activar la cuenta." . $mail->ErrorInfo);
        }

        return $message;
    }

    public function sendMail($data){

        $mail = new PHPMailer;
        $mail->Host = "smtpout.secureserver.net";
        $mail->Port = 25;
        $mail->SMTPAuth = false;
        $mail->setFrom('inksidepoesia@organicgrowerscolombia.com', 'Inkside Poesia');
        $mail->addAddress($data[0], $data[1]);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $nombre_poeta = explode(" ", $data[1]);
        $token = $data[3];
        switch ($data[2]) {
          case 'activaCuenta':
              $mail->Subject = "Activar Cuenta";
              include 'views/section/tmpMailer/activaCuenta.php';
          break;
        }

        if (!$mail->send()) {
            $message = array(0, "Mailer Error: " . $mail->ErrorInfo);
        } else {
            $message = array(1, "El registro ha sido exitoso, por favor verifique el correo electronico para activar la cuenta." . $mail->ErrorInfo);
        }

        return $message;
    }


    public function sendDedicatoria($poeta, $pub_codigo, $email){

        $mail = new PHPMailer;
        $mail->Host = "smtpout.secureserver.net";
        $mail->Port = 25;
        $mail->SMTPAuth = false;
        $mail->setFrom('inksidepoesia@organicgrowerscolombia.com', 'Inkside Poesia');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->Subject = "Hola te han dedicado un poema!";
        include 'views/section/tmpMailer/dedicatoria.php';


        if (!$mail->send()) {
            $message = array(0, "Mailer Error: " . $mail->ErrorInfo);
        } else {
            $message = array(1, "La dedicatoria se ha enviado correctamente, Gracias por hacer que la comunidad crezca." . $mail->ErrorInfo);
        }

        return $message;
    }

    public function sendDedicaPublic($data){

        $pub_codigo     = $data[0];
        $pub_nombre     = $data[1];
        $nombre_origen  = $data[2];
        $nombre_destino = $data[3];
        $correo_destino = $data[4];

        $mail = new PHPMailer();
        $mail->Host = "smtpout.secureserver.net";
        $mail->Port = 25;
        $mail->SMTPAuth = false;
        $mail->setFrom('inksidepoesia@organicgrowerscolombia.com', 'Inkside Poesia');
        $mail->addAddress($correo_destino);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->Subject = "Hola, $nombre_origen te ha dedicado un poema!";
        include 'views/section/tmpMailer/dedicatoriaPublica.php';


        if (!$mail->send()) {
            $message = array(0, "Mailer Error: " . $mail->ErrorInfo);
        } else {
            $message = array(1, "La dedicatoria se ha enviado correctamente, Gracias por hacer que la comunidad crezca." . $mail->ErrorInfo);
        }

        return $message;
    }
}

?>
