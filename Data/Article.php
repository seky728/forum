<?php


namespace Data;

require_once "Comment.php";


use Services\PDOConnector;

class Article
{

    private $id;
    private $title;
    private $text;
    private $idUser;
    private $timeStamp;
    private $comments = array();

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

    public function loadComments()
    {

        $sql = "select * from comments where id_article = :articleId";
        $connector = new PDOConnector();
        $pdo = $connector->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute(array(':articleId' => $this->id)) or die("Not able to load comments");
        $data = $sth->fetchAll();
        foreach ($data as $comment) {
            $this->comments[] = new Comment($comment[0], $comment[1], $comment[2], $comment[3], $comment[4]);
        }

    }

    /**
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
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