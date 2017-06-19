<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <title>Inkside</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
        <link rel="shortcut icon" href="http://www.inksidepoesia.com/images/stories/logos/logo.png">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

        <style type="text/css">
            body{
            }
            div.container{
                width: 1000px;
                margin: 0 auto;
                position: relative;
            }
            legend{
                font-size: 30px;
                color: #555;
            }
            .btn_send{
                background: #00bcd4;
            }
            label{
                margin:10px 0px !important;
            }
            textarea{
                resize: none !important;
            }
            .fl_window{
                width: 400px;
                position: absolute;
                right: 0;
                top:100px;
            }
            pre, code {
                padding:10px 0px;
                box-sizing:border-box;
                -moz-box-sizing:border-box;
                webkit-box-sizing:border-box;
                display:block; 
                white-space: pre-wrap;  
                white-space: -moz-pre-wrap; 
                white-space: -pre-wrap; 
                white-space: -o-pre-wrap; 
                word-wrap: break-word; 
                width:100%; overflow-x:auto;
            }

        </style>
    </head>
    <body>
       
        <div class="container">
            <div class="fl_window">
                <div><img src="http://www.inksidepoesia.com/images/stories/logos/logo.png" width="200" alt="Firebase"/></div>
                <br/>
             
            </div>

         
            <br/><br/><br/><br/>

            <form class="pure-form pure-form-stacked" method="POST" enctype="multipart/form-data" name="formulario" id="formulario" action="envio.php">
                <fieldset>
                    <legend>Envio Masivo de Notificaciones</legend>

                    <label for="title1">Titulo de Notificación</label>
                    <input type="text" id="title1" name="title" class="pure-input-1-2" placeholder="Ingrese el Titulo" required>

                    <label for="message1">Mensaje</label>
                    <textarea class="pure-input-1-2" name="message" id="message1" rows="5" placeholder="Mensaje de Notificacion" required></textarea>

		    <label>
		      <input type="file" name="fileToUpload" id="fileToUpload">
		    </label>		

                    <label for="include_image1" class="pure-checkbox">
                        <input id="include_image1" name="include_image" type="checkbox"> Incluir Imagen
                    </label>
                    <input type="hidden" name="push_type" value="topic"/>
<button type="submit" class="pure-button pure-button-primary btn_send">Enviar Notificación</button>
                    
                </fieldset>
            </form>
        </div>
    </body>
</html>
