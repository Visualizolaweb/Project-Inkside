<?php
session_start();
require_once 'model/conn.model.php';
require_once 'controller/init.controller.php';

  if(isset($_REQUEST["c"])){

    $controller = strtolower($_REQUEST["c"]);
    $action = isset($_REQUEST["a"]) ? $_REQUEST["a"]: "main";

    require_once "controller/$controller.controller.php";
    $controller = ucwords($controller).'Controller';

    $controller = new $controller;

    call_user_func(array($controller, $action));
  }else{
    
    $controller = "views";
    require_once "controller/$controller.controller.php";

    $controller = ucwords($controller).'Controller';
    $controller = new $controller;

    $controller->index();

  }

?>
