<?php


namespace Data;


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