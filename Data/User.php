<?php


namespace Data;


use http\Exception\RuntimeException;
use Services\PDOConnector;


require_once "Data.php";
require_once "Services/PDOConnector.php";


class User implements Data
{

    private $id;
    private $name;
    private $surname;
    private $email;
    private $userName;
    private $password;
    private $pdoConnector;

    /**
     * User constructor.
     * @param PDOConnector $pdoConnector
     */
    public function __construct($pdoConnector)
    {
        $this->pdoConnector = $pdoConnector;
    }


    public function loginUser($userName, $password)
    {

        $pdo = $this->pdoConnector->getPdo();
        $sql = "select * from users where User_name = :userName";
        $sth = $pdo->prepare($sql);
        $sth->execute([":userName" => $userName]) or die("Not able to select user by userName");
        if ($sth->columnCount() == 0) {
            throw new RuntimeException("Nikdo takový nebyl v db nalezen");
        }

        $user = $sth->fetchAll()[0];

        if ($user["Password"] !== $password) {
            throw new RuntimeException("Hesla se neshodují");
        }
        $_SESSION["userId"] = $user["Id"];
    }

    public function loadUserName($id)
    {
        $pdo = $this->pdoConnector->getPdo();
        $sql = "select name, surname, email, user_name from users where id = :idUser";
        $sth = $pdo->prepare($sql);
        $sth->execute(["idUser" => $id]) or die("not able to load user");
        if ($sth->columnCount() == 0) {
            throw new RuntimeException("Nikdo nebyl nalezen");
        }

        $user = $sth->fetchAll()[0];
        $this->createUser($id, $user["name"], $user["surname"], $user["email"], $user["user_name"]);
    }

    public function createUser($id, $name, $surname, $email, $userName)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->userName = $userName;
    }


    public function logout()
    {
        session_unset();
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }


}
