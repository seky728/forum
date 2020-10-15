<?php


namespace Data;


use Services\PDOConnector;

class Comment implements Data
{
    private $id;
    private $text;
    private $timestamp;
    private $id_user;
    private $id_article;
    private $pdoConnector;

    private $authorName;

    /**
     * Comment constructor.
     * @param $pdoConnector
     * @param $id
     * @param $text
     * @param $timestamp
     * @param $id_user
     * @param $id_article
     */
    public function __construct($pdoConnector, $id, $text, $timestamp, $id_user, $id_article)
    {
        $this->pdoConnector = $pdoConnector;
        $this->id = $id;
        $this->text = $text;
        $this->timestamp = $timestamp;
        $this->id_user = $id_user;
        $this->id_article = $id_article;
    }

    public function insertComment()
    {
        $sql = "INSERT INTO comments (Id, Text, Timestamp, Id_user, Id_article) VALUES (NULL, :commentText, CURRENT_TIMESTAMP, :idUser, :idArticle)";
        $pdo = $this->pdoConnector->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute(array(':commentText' => $this->text, ':idUser' => $this->id_user, ':idArticle' => $this->id_article)) or die("Not able to insert comment");
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
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param mixed $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }


}