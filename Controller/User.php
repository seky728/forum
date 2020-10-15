<?php


namespace Controller;


use Services\PDOConnector;
use View\View;

require_once "Data/User.php";


class User implements Controller
{
    private $pdoConnector;

    /**
     * User constructor.
     * @param $pdoConnector
     */
    public function __construct($pdoConnector)
    {
        $this->pdoConnector = $pdoConnector;
    }


    public function requireData()
    {
        // TODO: Implement requireData() method.
    }

    public function draw(View $view)
    {
        echo $view->requireTemplate(array());
    }

    public function actionForm()
    {

        if (isset($_POST["logout"])) {
            $this->logout();
            return;
        }


    }

    public function login()
    {
        $name = $_POST["userName"];
        $password = $_POST["password"];

        $user = new \Data\User($this->pdoConnector);
        $user->loginUser($name, $password);
        unset($_POST);
    }

    public function logout()
    {
        $user = new \Data\User($this->pdoConnector);
        $user->logout();
    }


}