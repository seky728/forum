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

    if (isset($_POST)) { // <--------------- pokud je zaslán form tak action by mělo být nastaveno na název controlleru, takže se requested uri by mělo obsahovat rovnou controller
        $self = $_SERVER['REQUEST_URI'];
        $controllerClass = explode("/", $self);
        $controllerClass = $controllerClass[count($controllerClass) - 1];
        $controllerClass = explode(".php", $controllerClass)[0];
        $path = $controllerClass;

    }

    if (!isset($_SESSION['userId'])) {
        $path = "user";
    }

    $self = $_SERVER['REQUEST_URI'];
    $self = rtrim($self, "/"); // <--- mohlo by způsobovat provlémy, dával by se do metod další parametr a to prázdný string ""
    $self = explode("/", $self); // rozsekal jsem si url podle /, 0. by mělo být "forum", 1. file


    if ($path === "") {
        if (!isset($self[2])) {
            $path = "HomePage";
        } else {
            $path = '' . $self[2] . '';
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

        $args = "";
        if (count($self) > 3) {
            $args = "$self[3]";

            for ($i = 4; $i < count($self); $i++) {
                $args .= ", $self[$i]";
            }
            $args .= "";

        }

        $controller = new $controllerClass($args);
        if (!empty($_POST)) {
            $controller->actionForm();
        }
        $view = new $viewClass();

        $controller->draw($view);

    } else {
        print_r("Controller file $controllerFile does not exist");
    }

}

