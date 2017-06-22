<?php
class DataBase{

  // CONEXION INKSIDE
  private static $db_host = "host397.hostmonster.com";
  private static $db_name = "inksidep_cloud";
  private static $db_user = "inksidep_cliente";
  private static $db_pass = "9d^3s&~p!]L.";
  
  // // CONEXION VISUALIZO
  // private static $db_host = "localhost";
  // private static $db_name = "bsstudio_inkside";
  // private static $db_user = "bsstudio_develop";
  // private static $db_pass = "Guille1037571915";

  private static $cont    = null;

public static function connect(){
    if(self::$cont == null){

      try{
        self::$cont = new PDO("mysql:host=".self::$db_host.";"."dbname=".self::$db_name, self::$db_user, self::$db_pass);
        self::$cont -> exec("SET CHARACTER SET utf8");
      }catch(PDOException $e){
        die($e->getMessage());
      }

    }

    return self::$cont;
  }

  # Creamos la funcion para desconectarnos de la base de datos
  public static function disconnect(){
    self::$cont = null;
  }

}
?>
