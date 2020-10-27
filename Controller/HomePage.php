<?php

namespace Controller;

include('Services/PDOConnector.php');

use Data\Articles;
use Data\Comment;
use View\View;


class HomePage implements Controller
{


    private $pdoConnector;
    private $data = array();
    private $numOnPage = 5;


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
        $articles->maxPages($this->numOnPage);
        $_SESSION["maxPages"] = $articles->getMaxPages()[0]; //bohužel jsem prostě neměl jinou možnost jak to přenést do view

        if (empty($this->data)) {

            $this->data = $articles->loadArticles();
        }
    }

    public function pagination($page, $numOnPage = "")
    {

        if ($numOnPage === "") {
            $numOnPage = $this->numOnPage;
        } else {
            $this->numOnPage = $numOnPage;
        }

        $articles = new Articles($this->pdoConnector);


        if ($page <= (int)$_SESSION["maxPages"]) {
            $this->data = $articles->loadArticles($page, $numOnPage);

        } else {
            var_dump($_SESSION["maxPages"]);
            $this->data = $articles->loadArticles($_SESSION["maxPages"], $numOnPage);


        }
    }

    public function draw(View $view)
    {
        $this->requireData();
        echo $view->requireTemplate($this->data);
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