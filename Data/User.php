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
        $userName = htmlspecialchars($userName);
        $password = htmlspecialchars($password);

        $pdo = $this->pdoConnector->getPdo();
        $sql = "select * from users where User_name = :userName";
        $sth = $pdo->prepare($sql);
        $sth->execute([":userName" => $userName]) or die("Not able to select user by userName");

        if ($sth->rowCount() == 0) {

            throw new \RuntimeException("Nikdo takový nebyl v db nalezen");
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
            throw new \RuntimeException("Nikdo nebyl nalezen");
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


    public function registerUser($name, $surname, $email, $userName, $password)
    {
        $name = htmlspecialchars($name);
        $surname = htmlspecialchars($surname);
        $email = htmlspecialchars($email);
        $userName = htmlspecialchars($userName);
        $password = htmlspecialchars($password);

        if ($this->isUserExtistByEmail($email)) {
            throw new \RuntimeException("tento email je již registrovaný");
        }

        if ($this->isUserExsitByNickName($userName)) {
            throw new \RuntimeException("Tato přezdívka je již použitá");
        }

        $pdo = $this->pdoConnector->getPdo();
        $sql = "INSERT INTO users (Id,Name, Surname, Email, User_name, Password) VALUES (NULL, :name, :surname, :email, :userName, :password);";
        $sth = $pdo->prepare($sql);
        $sth->execute(["name" => $name, "surname" => $surname, "email" => $email, "userName" => $userName, "password" => $password]) or die("not able to register user");
    }

    public function isUserExtistByEmail($email)
    {
        $pdo = $this->pdoConnector->getPdo();
        $sql = "select email from users where email like :email";
        $sth = $pdo->prepare($sql);
        $sth->execute(["email" => $email]) or die("not able to load email from db");
        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isUserExsitByNickName($nickName)
    {
        $pdo = $this->pdoConnector->getPdo();
        $sql = "select user_name from users where user_name like :userName";
        $sth = $pdo->prepare($sql);
        $sth->execute(["userName" => $nickName]) or die("not able to load nick name from db");
        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
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
