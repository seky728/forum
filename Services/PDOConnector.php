<?php
namespace Services;

use Data\Article;
use PDO;

require_once("Data/Articles.php"); // TODO: tohle neni treba + obecne tady ta fasada byt nemusi a můzes rovnou pouzit PDO, nemusis ale upravovat

class PDOConnector
{

    private $pdo;

    /**
     * PDOConnector constructor.
     */
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost:3308;dbname=diskuzni_forum", "root", "");
        //$sth = $pdo->prepare($sql, $values);
    }

    /**
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}