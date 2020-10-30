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
    private $maxPages = 0;
    private $currentPage = 0;


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
        $this->maxPages = $articles->getMaxPages()[0];

        if (empty($this->data)) {

            $this->data = $articles->loadArticles();
        }
    }

    public function pagination($page, $numOnPage = "")
    {

        $this->currentPage = $page;

        if ($numOnPage === "") {
            $numOnPage = $this->numOnPage;

        } else {
            $this->numOnPage = $numOnPage;

        }

        $articles = new Articles($this->pdoConnector);
        $articles->maxPages($numOnPage);
        $this->maxPages = (int)$articles->getMaxPages();

        if ($page <= $this->maxPages) {
            $this->data = $articles->loadArticles($page, $numOnPage);

        } else {
            $this->data = $articles->loadArticles($this->maxPages, $numOnPage);

        }
    }

    public function draw(View $view)
    {
        $this->requireData();
        $view->setMaxPage($this->maxPages);
        if ($this->currentPage + 1 <= $this->maxPages) {
            $view->setNextPage($this->currentPage + 1);
        } else {
            $view->setNextPage(null);
        }

        if ($this->currentPage - 1 >= 0) {
            $view->setPreviousPage($this->currentPage - 1);
        } else {
            $view->setPreviousPage(null);
        }

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
        //TODO
        echo "<script>alert('not working yet')</script>";
    }

    public function deleteComment($id)
    {
        //TODO
        echo "<script>alert('not working yet')</script>";
    }


    public function editComment($id)
    {
        //TODO
        echo "<script>alert('not working yet')</script>";
    }


}