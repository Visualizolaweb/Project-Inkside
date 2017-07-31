<meta charset="utf-8">
<?php

$text = "";
$texto = 'Salgo al encuentro de esa mirada tuya? <br><br> tan esquiva!<br><br> pero que me sigue cuando me voy…<br><br> Salgo al encuentro de la luna<br><br> que se esconde tras las nubes<br><br> y se escabulle tras el amor del sol…<br><br> Salgo al encuentro de ese beso <br><br> que se escapa de tu boca<br><br> y muere sin poder alcanzar mis labios…<br><br> Salgo al encuentro del sol<br><br> que se pierde en el horizonte<br><br> y escapa con su amante la mar…<br><br> Salgo al encuentro de tus caricias<br><br> que se quedan atrapadas en tus manos<br><br> queriéndose en mi cuerpo quedar…<br><br> Salgo al encuentro de las estrellas<br><br> que se pierden en mis lagrimas<br><br> con un sentimiento que se vuelve fugaz…<br><br> <br><br>';


$prueba = str_word_count($texto,1,'...¿?¡!àáéèíìóòúù.,');

foreach ($prueba as $key => $value) {
  if($key <= 90){


   if($value != "br"){
     $text .= ' '.$value;
   }else{
     $text .= "<br>";
   }

 }elseif($key == 91){
    $text .= "...";
 }

}

echo $text;
?>
