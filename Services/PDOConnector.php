<?php
namespace Services;

use Data\Article;
use PDO;

require_once ("Data/Article.php");

class PDOConnector
{

    private $pdo;

    /**
     * PDOConnector constructor.
     */
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost:3308;dbname=diskuzni_forum","root","");
        //$sth = $pdo->prepare($sql, $values);

    }

    public function getArticles($sql, array $values){

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
        $data = $stmt->fetchAll();
        $articles = array();
        foreach ($data as $item) {
            $articles[] = new Article($item[0], $item[1],$item[2],$item[3],$item[4]);
        }

        return $articles;
    }
}