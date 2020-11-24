<?php


namespace Controller;


use Data\User;
use Exception;
use http\Exception\RuntimeException;
use View\View;

class SignPage implements Controller
{

    private $pdoConenctor;

    /**
     * SignPage constructor.
     */
    public function __construct($pdoConenctor)
    {
        $this->pdoConenctor = $pdoConenctor;
    }

    public function requireData()
    {
        //není potřeba načítat data při načítání stránky
        return null;
    }

    public function draw(View $view)
    {
        echo $view->requireTemplate(array());
    }


    public function login()
    {
        $user = new User($this->pdoConenctor);

        $user->loginUser($_POST["name"], $_POST["password"]);

        header("Location: /Homepage");
    }

    public function register()
    {
        $user = new User($this->pdoConenctor);
        if ($_POST["name"] != "" && $_POST["surname"] != "" && $_POST["email"] != "" && $_POST["nickName"] != "" && $_POST["password"] && $_POST["password"] === $_POST["passwordAgain"]) {
            $user->registerUser($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["nickName"], $_POST["password"]);
            $user->loginUser($_POST["nickName"], $_POST["password"]);
            header("Location: /Homepage");
        } else {
            throw new Exception("Registrace nebyla správně vyplěna");
        }
    }

    public function logout()
    {
        $user = new User($this->pdoConenctor);
        $user->logout();
    }
}