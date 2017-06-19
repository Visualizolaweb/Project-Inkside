 <?php
 
        error_reporting(-1);
        ini_set('display_errors', 'On');

        require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();
        $push = new Push();


        $title = $_POST['title'];

        $message = $_POST['message'];

        $push_type = $_POST['push_type'];
 
	$include_image = isset($_POST['include_image']) ? TRUE : FALSE; 
	
	if ( !!$_FILES['fileToUpload']['tmp_name'] ) 
	{
		$temporal=$_FILES['fileToUpload']['tmp_name'];
		$nombre=$_FILES['fileToUpload']['name'];

		move_uploaded_file($temporal,'images/'.$nombre);
		 $url="http://www.ingoskr10.com/inksidenoti/images/".$nombre;
		 
	}else
	{
	
	}	 
		

	/*$allow = array("jpg", "jpeg", "gif", "png");

	$todir = 'images/';

	if ( !!$_FILES['fileToUpload']['tmp_name'] ) 
	{
	    $info = explode('.', strtolower( $_FILES['fileToUpload']['name']) ); 

	    if ( in_array( end($info), $allow) ) 
	    {
        	if ( move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $todir . basename($_FILES['fileToUpload']['name'] ) ) )
	        {
	        
	        
	        $url="http://www.ingoskr10.com/Notification/".$todir.$_FILES['fileToUpload']['name'];
		echo $url;
	        }
	    }
	    else
	    {

	    }
	}*/
	
	 
        $push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) 
        {
        
           // $push->setImage('http://www.ocudos.com/wp-content/uploads/2015/05/coordinadora.png');
           $push->setImage($url);
        } else {
            $push->setImage('');
        }
        $push->setIsBackground(FALSE);

        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
        }
      	echo '<script language="javascript">';
	echo 'alert("MENSAJE ENVIADO CORRECTAMENTE")';
	echo '</script>';
	echo "<script>location.href = 'index.php';</script>";
        ?>