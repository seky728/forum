<?php


use Services\PDOConnector;


session_start();


/**
 * @var Controller\Controller
 */
$controller = null;


$__NAMESPACE_CONTROLLER_ = "Controller\\";
$__NAMESPACE_VIEW_ = "\\View\\";

/*------------ interfaces ----------------*/
// TODO: tyhle veci je lepsi resit autoloadrem viz, ktery si muzes zaregistrovat pres funkci spl_autoload_register
// TODO: viz https://www.php.net/manual/en/language.oop5.autoload.php
// TODO: pak vsechny tridy, ktere nemas requirenute skoci do autoloaderu a tam dle nejake logiky (kterou si nadefinujes) tu tridu nactou
// TODO: to jak ten autoloader nadefinuješ by v ideálním případě mělo odpovídat PSR-4 standardu viz https://www.php-fig.org/psr/psr-4/
// TODO: kdyby tu nebylo neco jasne, tak se určite ptes.
//require_once("View/View.php");
//require_once("Controller/Controller.php");
//TODO: To stačilo opravdu jen takhle?
spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});


set_exception_handler(function ($exception) {
    echo "Uncaught exception: ", $exception->getMessage(), "\n";
});


if (isset($_SERVER)) {
    $path = ""; // TODO: v PHP se obecne vice priklani k pouziti single quotes ($path = '';) - je to mene nachylne na chyby a lehce rychlejsi
    // TODO: nelpim sice na tom pouzivat single quotes, ale urcite je lepsi drzet nejakou strukturu a ne to mit takhle splacane (nekde single nekde double) :-)

    $self = $_SERVER['REQUEST_URI'];
    $self = rtrim($self, "/"); // <--- mohlo by způsobovat problémy, dával by se do metod další parametr a to prázdný string ""
    $self = explode("/", $self); // rozsekal jsem si url podle /, 0. by mělo být "forum", 1. file

    if ($path === "") {
        if (!isset($self[1])) {
            $path = 'HomePage';
        } else {
            $path = '' . $self[1] . ''; // TODO: tohle vlozeni do stringu jednak neni nute a za druhe je lepsi pouzit type casting (string) $self[1]
            $path = explode(".php", $path)[0];
        }
    }


    $path = ucfirst($path);
    $controllerFile = __DIR__ . "/Controller/" . $path . ".php";
    $viewFile = __DIR__ . "/View/" . $path . ".php";


    if (file_exists($controllerFile)) {
        // TODO: to same jako vys - ten autoloader
        // require_once $controllerFile;
        // require_once $viewFile;
        //require_once("Services/PDOConnector.php");
        $controllerClass = $__NAMESPACE_CONTROLLER_ . $path;
        $viewClass = $__NAMESPACE_VIEW_ . $path;

        $method = "";
        if (count($self) > 2) { // TODO: i kdyz to je tady jedno, tak count sam o sobe ti nezajisti ten index 2 (associativni pole)
            $method = "$self[2]"; // TODO: stejne jako vyse
        }
        // TODO: cele bych to jinak prepsal pomoci ternarniho operatoru takto:
        // $method = isset($self[2]) ? $self[2] : '';

        $args = array();
        if (count($self) > 2) {

            // TODO: na tohle obzvlášť pozor, ten count v tom foru se takhle počítá pro každý krok v cyklu
            // TODO: u takhle malého pole tj jedno, ale u větších polí by to už bylo dost znát
            // TODO: i když to tady ale nevadí, rozhodně to nepouzivej, at si to zajizes :-) Ten count pouzivat i vyse, vloz si ho tedy hned nahore do promenne a vyuzivej promennou.
            for ($i = 3; $i < count($self); $i++) {
                $args[] .= $self[$i];
            }


        }

        $pdoConnector = new PDOConnector();

        $controller = new $controllerClass($pdoConnector);
        if (!empty($method)) {

            call_user_func_array(array($controller, $method), $args);
            // $controller->$method(implode(",",$args));
        }

        $view = new $viewClass();

        $controller->draw($view);

    } else {
        print_r("Controller file $controllerFile does not exist");
    }

}

