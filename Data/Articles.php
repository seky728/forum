<?php


namespace Data;
use Services\PDOConnector;

require_once("Data.php");
require_once("Article.php");


class Articles implements Data
{
    private $pdoConnector;

    /**
     * Articles constructor.
     * @param $pdoConnector
     */
    public function __construct($pdoConnector)
    {
        $this->pdoConnector = $pdoConnector;
    }


    public function loadArticles()
    {
        $sql = "select * from article order by timestamp DESC ";

        $pdo = $this->pdoConnector->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll();
        foreach ($data as $item) {
            $idUser = $item[3];
            $user = new User($this->pdoConnector);
            $user->loadUserName($idUser);
            $article = new Article($this->pdoConnector, $item[0], $item[1], $item[2], $item[3], $item[4]);
            $article->loadComments();
            $article->setAuthorName($user->getUserName());
            $articles[] = $article;
        }
        return $articles;
    }


    public function insertArticles($title, $text, $idUser)
    {
        if (empty($title) || empty($text)) {
            print_r("Title a text nesmí být prázdný"); //TODO make error page
        } else {
            $sql = "insert into article (Id, Title, Text, Id_user, Timestamp) values (null, :title, :text, :idUser, CURRENT_TIMESTAMP)";
            $pdo = $this->pdoConnector->getPdo();
            $sth = $pdo->prepare($sql);
            $sth->execute(array(':title' => $title, ':text' => $text, ':idUser' => $idUser)) or die("Not able to make insert request for article");
        }
    }


}

