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

    /**
     * Comment constructor.
     * @param $id
     * @param $text
     * @param $timestamp
     * @param $id_user
     * @param $id_article
     */
    public function __construct($id, $text, $timestamp, $id_user, $id_article)
    {
        $this->id = $id;
        $this->text = $text;
        $this->timestamp = $timestamp;
        $this->id_user = $id_user;
        $this->id_article = $id_article;
    }

    public function insertComment()
    {
        $sql = "INSERT INTO comments (Id, Text, Timestamp, Id_user, Id_article) VALUES (NULL, :commentText, CURRENT_TIMESTAMP, :idUser, :idArticle)";
        $connector = new PDOConnector();
        $pdo = $connector->getPdo();
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


}