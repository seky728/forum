<?php

namespace Controller;

include('Services/PDOConnector.php');

use Data\Articles;
use View\View;


class HomePage implements Controller
{


    /**
     * HomePageController constructor.
     */
    public function __construct()
    {
    }

    public function requireData()
    {
        $articles = new Articles();
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

            $articles = new Articles();
            $articles->insertArticles($_POST['title'], $_POST['text'], $idUser);
        }

    }

    public function addComment()
    {

    }

    public function actionForm()
    {
        // TODO: Implement actionForm() method.
    }
}