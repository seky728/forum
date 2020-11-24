<?php


namespace Controller;


use Data\User;
use Data\Users;
use Exception;
use Services\PDOConnector;
use View\View;

class AdministrationPage implements Controller
{

    private $pdo;

    /**
     * AdministrationPage constructor.
     * @param PDOConnector $pdo
     */
    public function __construct(PDOConnector $pdo) // TODO: od PHP7 můžeš pouzit deklaraci typu -> PDOConnector $pdo, mas tak jistotu, ze to tam nikdo neda nic jineho, IDE ti naseptava atd | ok
    {
        $this->pdo = $pdo;
    }

    public function requireData()
    {
        $users = new Users($this->pdo);
        return $users->loadUsers(); // TODO: muzes rovnou zapsat jako: $users->loadUsers(); | ok

    }

    public function draw(View $view)
    {
        $this->requireData();
        echo $view->requireTemplate($this->requireData());
    }



    public function editUser()
    {
        // TODO: je lepsi, aby ty funkce vubec nevyuzivali globalni promenne. $_SESSION ok, ale $_POST alespon predat jako parameter akce |------ tohle nechápu
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
            throw new Exception("Hesla se neshodují");
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