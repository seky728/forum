<?php


namespace Data;

require_once "Comment.php";
require_once "User.php";


use Services\PDOConnector;

class Article
{

    private $id;
    private $title;
    private $text;
    private $idUser;
    private $timeStamp;
    private $comments = array();
    private $pdoConnector;

    private $authorName;

    /**
     * Article constructor.
     * @param $pdoConnector
     * @param $id
     * @param $title
     * @param $text
     * @param $idUser
     * @param $timeStamp
     */
    public function __construct($pdoConnector, $id, $title, $text, $idUser, $timeStamp)
    {
        $this->pdoConnector = $pdoConnector;
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->idUser = $idUser;
        $this->timeStamp = $timeStamp;
    }

    public function loadComments()
    {

        $sql = "select * from comments where id_article = :articleId";
        $pdo = $this->pdoConnector->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute(array(':articleId' => $this->id)) or die("Not able to load comments");
        $data = $sth->fetchAll();
        foreach ($data as $comment) {
            $idUser = $comment[3];
            $user = new User($this->pdoConnector);
            $user->loadUserName($idUser);
            $loadedComment = new Comment($this->pdoConnector, $comment[0], $comment[1], $comment[2], $comment[3], $comment[4]);
            $loadedComment->setAuthorName($user->getUserName());
            $this->comments[] = $loadedComment;

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