<?php

namespace Controller;

include('Services/PDOConnector.php');

use Data\Articles;
use Data\Comment;
use View\View;


class HomePage implements Controller
{


    private $pdoConnector;

    /**
     * HomePageController constructor.
     */
    public function __construct($pdoConnector)
    {
        $this->pdoConnector = $pdoConnector;
    }

    public function requireData()
    {
        $articles = new Articles($this->pdoConnector);
        return $articles->loadArticles();

    }

    public function draw(View $view)
    {
        echo $view->requireTemplate($this->requireData());
    }


    public function sendNew()
    {

        if (isset($_SESSION["userId"])) {
            $idUser = $_SESSION["userId"];

            $articles = new Articles($this->pdoConnector);
            $articles->insertArticles($_POST['title'], $_POST['text'], $idUser);
        }

    }

    public function addComment($idArticle)
    {
        if (isset($_POST)) {
            $text = $_POST['commentText'];
            $comment = new Comment($this->pdoConnector, "", $text, null, $_SESSION['userId'], $idArticle);
            $comment->insertComment();

        }
    }

    public function actionForm()
    {
        // TODO: Implement actionForm() method.
    }
}