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
    $self = rtrim($self, "/");
    $self = explode("/", $self); // rozsekal jsem si url podle /, 0. by mělo být "forum", 1. file


    if (!isset($self[2])) {
        echo "you are at homepage";
        $controllerFile = __DIR__ . "/Controller/HomePageController.php";
        if (!file_exists($controllerFile)) {
            print_r("Home Page Controller does not exist");
        }


        require_once('' . $controllerFile . '');


        $controller = new HomePageController("Nějaký ten homepage test text");
        $controller->requireData();


    } else {
        $path = '' . $self[2] . '';
        $__NAMESPACE_CONTROLLER_ = "Controller\\";
        $__NAMESPACE_VIEW_ = "\\View\\";


        $controllerFile = __DIR__ . "/Controller/" . $path . ".php";
        $viewFile = __DIR__ . "/View/" . $path . ".php";


        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            require_once $viewFile;
            $controllerClass = $__NAMESPACE_CONTROLLER_ . $path;
            $viewClass = $__NAMESPACE_VIEW_ . $path;

            $args = "";
            if (count($self) > 3) {
                $args = "$self[3]";

                for ($i = 4; $i < count($self); $i++) {
                    $args .= ", $self[$i]";
                }
                $args .= "";

            }

            $controller = new $controllerClass($args);
            $data = $controller->requireData();
            $view = new $viewClass();

            $controller->draw($view);

        } else {
            print_r("Controller file $controllerFile does not exist");
        }
    }





}
