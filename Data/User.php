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


    public function loginUser($userName, $password)
    {
        $connector = new PDOConnector();
        $pdo = $connector->getPdo();
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

    public function logout()
    {
        session_unset();
    }


}
