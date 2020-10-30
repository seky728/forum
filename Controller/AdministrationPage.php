<?php


namespace Controller;
require_once "Controller.php";
require_once "Data/Users.php";
require_once "Data/User.php";

use Data\User;
use Data\Users;
use http\Exception\RuntimeException;
use View\View;

class AdministrationPage implements Controller
{

    private $pdo;

    /**
     * AdministrationPage constructor.
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function requireData()
    {
        $users = new Users($this->pdo);
        $data = $users->loadUsers();
        return $data;

    }

    public function draw(View $view)
    {
        $this->requireData();
        echo $view->requireTemplate($this->requireData());
    }



    public function editUser()
    {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $nickName = $_POST["nickName"];
        $password = $_POST["password"];
        $checkPassword = $_POST["passwordAgain"];

        if ($password === $checkPassword) {
            $user = new User($this->pdo);
            $user->editUser($_SESSION["userId"], $name, $surname, $email, $nickName, $password);
        } else {
            throw new RuntimeException("Hesla se neshodují");
        }


    }

    public function rightsDown($idUser)
    {
        $user = new User($this->pdo);
        $user->rightsDown($idUser);
    }

    public function rightsUp($idUser)
    {
        $user = new User($this->pdo);
        $user->rightsUp($idUser);
    }

}