<?php

$mail->Body = '<!DOCTYPE html><html><head><meta charset="utf-8">
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;background:#f9f9f9"><tbody><tr><td valign="top" style="font-family:Helvetica,Arial,sans-serif!important;border-collapse:collapse">
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse"><tbody><tr><td  style="font-family:Helvetica,Arial,sans-serif!important;border-collapse:collapse;">
</td>
</tr></tbody></table></td>
</tr><tr><td valign="top" style="font-family:Helvetica,Arial,sans-serif!important;border-collapse:collapse"><br>
<table cellpadding="32" cellspacing="0" border="0" align="center" style="border-collapse:collapse;background:white;border-radius:0.5rem;margin-bottom:1rem"><tbody><tr><td width="546" valign="top" style="font-family:Helvetica,Arial,sans-serif!important;border-collapse:collapse">
<div style="max-width:600px;margin:0 auto">
<div style="background:white;border-radius:0.5rem;margin-bottom:1rem">
<h2 style="color:#00bcd4;line-height:30px;margin-bottom:12px;margin:0 0 12px">Información <span class="il">de la cuenta.</span></h2>
<p style="font-size:17px;line-height:24px;margin:0 0 16px">
Hola '.$nombre_poeta[0].',
</p>
<p style="font-size:17px;line-height:24px;margin:0 0 16px">
<span class="il">Para crear una nueva contraseña, haz clic en el boton "RECUPERAR CUENTA"</span>
</p>
<p style="font-size:17px;line-height:24px;margin:0 0 16px"></p>
<a href="'.$_SERVER['HTTP_REFERER'].'password-'.base64_encode($data[2]).'" style="text-decoration:none;margin:0 0 16px;cursor: pointer;color:white;border-radius:8px;border:2px solid #26c6da;height:20%;background-color:#00bcd4;width:42%;height:8vh;font-size:3vh;margin-top:1%;font-family:sans-serif; display:block; text-align:center;line-height:2.5">RECUPERAR CUENTA</a>
<p style="font-size:17px;line-height:24px;margin:0 0 16px">
Si tienes alguna pregunta, envianos un correo a <a  style="color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word" target="_blank">inksidepoesia@<span class="il">gmail</span>.com</a>. Nos encantaría ayudarte
</p>
<p style="font-size:17px;line-height:24px;margin:0 0 16px">
Gracias,<br>
Tus amigos de <span style="color:#42a5f5;font-weight:bold;">Inkside Poesía.</span>
</p>
</div>
</div>
</td>
</tr></tbody></table></td>
</tr></tbody></table>
</body>
</html>';
?>
