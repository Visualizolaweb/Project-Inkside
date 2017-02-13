<?php
	class Conexion{

		const BD_HOST = "localhost";
		// const BD_HOST = "dnjs2.wnkserver2.com:3306";
    const BD_NAME = "muestra";
    const BD_USER = "root";
    const BD_PASS = "";

		private static $conex = null;

		protected static final function Abrirbd(){
			if(self::$conex == null){
				try {
					self::$conex = new PDO('mysql:host='.self::BD_HOST.';dbname='.self::BD_NAME.';charset=utf8',self::BD_USER, self::BD_PASS);
					self::$conex -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
				catch(PDOException $e){
					echo $e->getMessage();
				}
			}return self::$conex;
		}
		protected static final function Cerrarbd(){
			self::$conex = null;
		}
	}
?>
