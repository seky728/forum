<?php


namespace Data;


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
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }




}