<?php


namespace Controller;


use Data\Data;
use Services\PDOConnector;
use View\View;


require_once("Services\PDOConnector.php");


class Hello implements Controller
{

    /**
     * HelloController constructor.
     */
    public function __construct($name)
    {
        echo "Tohle je konstruktér hello $name";
    }

    /**
     * @return Data[]
     */
    public function requireData()
    {
        $connector = new PDOConnector();
        $articles = $connector->getArticles('select * from article where id = ?', array(1));
        return $articles;
    }

    public function draw(View $view)
    {
        echo $view->requireTemplate($this->requireData()[0]);
    }


}