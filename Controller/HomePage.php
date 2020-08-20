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
        $articles = $connector->getArticles('select * from article where id = ?', array(1));

        return $articles;

    }

    public function draw(View $view)
    {
        echo $view->requireTemplate($this->requireData()[0]);
    }

    public function actionForm()
    {
        $text = $_POST["prispevek"];
        echo "<h1>Tohle jsi mi poslal: $text</h1>";
    }
}