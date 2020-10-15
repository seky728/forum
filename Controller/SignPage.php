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
        // TODO: Implement requireData() method.
    }

    public function draw(View $view)
    {
        // TODO: Implement draw() method.
        echo $view->requireTemplate(array());
    }

    public function actionForm()
    {
        // TODO: Implement actionForm() method.
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