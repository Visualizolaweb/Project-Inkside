<?php

DEFINE('urlsitio','http://organicgrowerscolombia.com/');

class DataBase{

  // CONEXION INKSIDE
  private static $db_host = "p3plcpnl0817.prod.phx3.secureserver.net";
  private static $db_name = "inksidep_cloud";
  private static $db_user = "inksidepoesia";
  private static $db_pass = "U7C&ncNrKy28G";


  // // CONEXION VISUALIZO
  // private static $db_host = "localhost";
  // private static $db_name = "inksidep_cloud";
  // private static $db_user = "root";
  // private static $db_pass = "";

  private static $cont  = null;

  public static function connect(){
    if(self::$cont == null){

      try{

        self::$cont = new PDO("mysql:host=".self::$db_host.";"."dbname=".self::$db_name, self::$db_user, self::$db_pass);
        self::$cont -> exec("set names utf8");

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
