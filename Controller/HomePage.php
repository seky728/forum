<?php

namespace Controller;

include('Services/PDOConnector.php');

use Services\PDOConnector;
use View\View;


class HomePage implements Controller
{

    public $test;

    /**
     * HomePageController constructor.
     */
    public function __construct()
    {


    }

    public function requireData()
    {

        echo $this->test;
        $connector = new PDOConnector();
        $articles = $connector->getArticles('select * from article order by timestamp', array());

        return $articles;

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
        $connector = new PDOConnector();
        $connector->insert('insert into article (Id, Title, Text, Id_user, Timestamp) Values (null, ?, ?, 1, CURRENT_TIMESTAMP)', array($_POST["title"], $_POST["text"]));

    }
}