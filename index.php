<?php
session_start();

/**
 * @var Controller\Controller
 */
$controller = null;


$__NAMESPACE_CONTROLLER_ = "Controller\\";
$__NAMESPACE_VIEW_ = "\\View\\";

/*------------ interfaces ----------------*/
require_once("View/View.php");
require_once("Controller/Controller.php");


if (isset($_SERVER)) {
    $path = "";


    $self = $_SERVER['REQUEST_URI'];
    $self = rtrim($self, "/"); // <--- mohlo by způsobovat problémy, dával by se do metod další parametr a to prázdný string ""
    $self = explode("/", $self); // rozsekal jsem si url podle /, 0. by mělo být "forum", 1. file

    if ($path === "") {
        if (!isset($self[1])) {
            $path = "HomePage";
        } else {
            $path = '' . $self[1] . '';
            $path = explode(".php", $path)[0];
        }
    }


    $path = ucfirst($path);
    $controllerFile = __DIR__ . "/Controller/" . $path . ".php";
    $viewFile = __DIR__ . "/View/" . $path . ".php";


    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        require_once $viewFile;
        $controllerClass = $__NAMESPACE_CONTROLLER_ . $path;
        $viewClass = $__NAMESPACE_VIEW_ . $path;


        $method = "";
        if (count($self) > 2) {
            $method = "$self[2]";
        }


        $args = "";
        if (count($self) > 2) {


            for ($i = 3; $i < count($self); $i++) {
                $args .= "$self[$i],";
            }
            $args = rtrim($args, ",");
            $args .= "";

        }

        $controller = new $controllerClass();

        if (!empty($method)) {
            $controller->$method($args);
        }

        $view = new $viewClass();

        $controller->draw($view);

    } else {
        print_r("Controller file $controllerFile does not exist");
    }

}

