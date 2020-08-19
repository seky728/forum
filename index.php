<?php

use Controller\HomePageController;

/**
 * @var Controller\Controller
 */
$controller = null;


/*------------ interfaces ----------------*/
require_once ("View/View.php");
require_once ("Controller/Controller.php");


if (isset($_SERVER)){
    $self = $_SERVER['REQUEST_URI'];
    $self = explode("/", $self); // rozsekal jsem si url podle /, 0. by mělo být "forum", 1. file


    if ($self[2] == ""){
        echo "you are at homepage";
        $findingFile = __DIR__."/Controller/HomePageController.php";
        if (!file_exists($findingFile)){
            print_r("Home Page Controller does not exist");
        }



        require_once (''.$findingFile.'');


        $controller = new HomePageController("Nějaký ten homepage test text");
        $controller->requireData();


    } else {
        $controllerFile = __DIR__."/Controller/".$self[2]."Controller.php";
        if (file_exists($controllerFile)){
            echo "Controller ".$controllerFile." exists";
        } else {
            print_r("Controller file $controllerFile does not exist");
        }
    }





}
