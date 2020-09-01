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

    public function actionForm()
    {
        if (isset($_POST["prispevek"])) {
            $this->sendNew();
        }

        unset($_POST);
    }

    private function sendNew()
    {
        if (isset($_SESSION["userId"])) {
            $idUser = $_SESSION["userId"];

            $articles = new Articles();
            $articles->inserArticles($_POST['title'], $_POST['text'], $idUser);
        }

    }
}