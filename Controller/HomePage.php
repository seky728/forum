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

        if (isset($_SESSION["userId"]) && $_POST['title'] != "" && $_POST['text'] != "") {
            $idUser = $_SESSION["userId"];

            $articles = new Articles($this->pdoConnector);
            $articles->insertArticles($_POST['title'], $_POST['text'], $idUser);
        } else {
            echo "musí být vyplněny políčka";
        }

    }

    public function addComment($idArticle)
    {
        if (isset($_POST)) {
            $text = $_POST['commentText'];
            $text = htmlspecialchars($text);
            $comment = new Comment($this->pdoConnector, "", $text, null, $_SESSION['userId'], $idArticle);
            $comment->insertComment();

        }
    }

    public function deleteArticle($id)
    {
        $articles = new Articles($this->pdoConnector);
        $articles->deleteArticle($id);


    }

    public function editArticle($id)
    {

    }

    public function deleteComment($id)
    {

    }


    public function editComment($id)
    {

    }

    public function actionForm()
    {
        // TODO: Implement actionForm() method.
    }
}