<?php
class DataBase{

  private static $db_host = "dnjs2.wnkserver2.com:3306";
	private static $db_name = "bsstudio_inkside";
	private static $db_user = "bsstudio_develop";
  private static $db_pass = "#OpXINsM@[Tp";

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
