<?php


namespace Controller;


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
        $user = new \Data\User($this->pdoConenctor);
        $user->loginUser($_POST["name"], $_POST["password"]);
        header("Location: /Homepage");
    }

    public function register()
    {
        $user = new \Data\User($this->pdoConenctor);
        $user->registerUser($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["nickName"], $_POST["password"]);
        $user->loginUser($_POST["nickName"], $_POST["password"]);
        header("Location: /Homepage");
    }

    public function logout()
    {
        $user = new \Data\User($this->pdoConenctor);
        $user->logout();
    }
}