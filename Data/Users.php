<?php


namespace Data;


use Exception;
use Services\PDOConnector;

class Users implements Data
{

    private $pdo;

    /**
     * Users constructor.
     * @param PDOConnector $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * @return array
     */
    public function loadUsers()
    {
        $pdo = $this->pdo->getPdo();
        $sql = "select id, name, surname, email, user_name, rights from users";
        $sth = $pdo->prepare($sql);
        if (!$sth->execute()) {
            throw new Exception("Not able to load all users");
        }
        if ($sth->columnCount() == 0) {
            throw new Exception("Nikdo nebyl nalezen");
        }
        $data = $sth->fetchAll();

        $users = array();

        foreach ($data as $item) {
            $user = new User($this->pdo);
            $user->createUser($item[0], $item[1], $item[2], $item[3], $item[4], "", $item[5]);
            $users[] = $user;
        }

        return $users;
    }

}