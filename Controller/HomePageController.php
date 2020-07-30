<?php

namespace Controller;

include('Services/PDOConnector.php');

use Services\PDOConnector;
use View\View;


class HomePageController implements Controller
{

    public $test;

    /**
     * HomePageController constructor.
     */
    public function __construct($test)
    {
        $this->test = $test;
    }

    public function requireData()
    {

        echo $this->test;
        $connector = new PDOConnector();
        $articles = $connector->getArticles('select * from article where id = ?', array(1));

        var_dump($articles);

    }

    public function draw(View $view)
    {

    }
}