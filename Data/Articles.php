<?php


namespace Data;
use http\Exception\RuntimeException;
use Services\PDOConnector;

require_once("Data.php");


class Articles implements Data
{
    public function loadArticles()
    {
        $sql = "select * from article order by timestamp ";
        $connector = new PDOConnector();
        $pdo = $connector->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll();
        foreach ($data as $item) {
            $articles[] = new Article($item[0], $item[1], $item[2], $item[3], $item[4]);
        }
        return $articles;
    }


    public function inserArticles($title, $text, $idUser)
    {
        if (empty($title) || empty($text)) {
            print_r("Title a text nesmí být prázdný"); //TODO make error page
        } else {
            $sql = "insert into article (Id, Title, Text, Id_user, Timestamp) values (null, :title, :text, :idUser, CURRENT_TIMESTAMP)";
            $connector = new PDOConnector();
            $pdo = $connector->getPdo();
            $sth = $pdo->prepare($sql);
            $sth->execute(array(':title' => $title, ':text' => $text, ':idUser' => $idUser)) or die("Not able to make insert request for article");
        }
    }

}

class Article
{

    private $id;
    private $title;
    private $text;
    private $idUser;
    private $timeStamp;

    /**
     * Article constructor.
     * @param $id
     * @param $title
     * @param $text
     * @param $idUser
     * @param $timeStamp
     */
    public function __construct($id, $title, $text, $idUser, $timeStamp)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->idUser = $idUser;
        $this->timeStamp = $timeStamp;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

}