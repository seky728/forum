<?php


namespace Data;
use Services\CheckText;
use Services\PDOConnector;

require_once("Data.php");
require_once("Article.php");
require_once("Services/CheckText.php");


class Articles implements Data
{
    private $pdoConnector;
    private $maxPages;

    /**
     * Articles constructor.
     * @param PDOConnector $pdoConnector
     */
    public function __construct($pdoConnector)
    {
        $this->pdoConnector = $pdoConnector;
    }

    public function maxPages($numOnPage)
    {
        $sql = "select COUNT(id)/:numOnPage from article";
        $pdo = $this->pdoConnector->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute([":numOnPage" => $numOnPage]) or die("Not able to calculate max count of pages");
        $data = $sth->fetchAll(); // TODO: muzes pouzit $sth->fetchColumn(), nevraci to pak pole
        $this->maxPages = $data[0];
    }


    public function loadArticles($page = 0, $numOnPage = 5)
    {

        $offset = (int)$page * $numOnPage;

        // TODO: nikdy never vstupum a vzdy pouzij prepared statments
        $sql = 'select * from article order by timestamp DESC limit ' . $numOnPage . ' offset ' . $offset . ' ';
        $articles = array();

        $pdo = $this->pdoConnector->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll();
        foreach ($data as $item) {
            $idUser = $item[3];
            $user = new User($this->pdoConnector);
            $user->loadUserName($idUser);
            $article = new Article($this->pdoConnector, $item[0], CheckText::allowTags($item[1]), CheckText::allowTags($item[2]), $item[3], $item[4]);
            $article->loadComments();
            $article->setAuthorName($user->getUserName());
            $articles[] = $article;
        }
        return $articles;
    }


    public function insertArticles($title, $text, $idUser)
    {

        if (empty($title) || empty($text)) {
            print_r("Title a text nesmí být prázdný"); //TODO make error page
        } else {
            $sql = "insert into article (Id, Title, Text, Id_user, Timestamp) values (null, :title, :text, :idUser, CURRENT_TIMESTAMP)";
            $pdo = $this->pdoConnector->getPdo();
            $sth = $pdo->prepare($sql);
            $sth->execute(array(':title' => $title, ':text' => $text, ':idUser' => $idUser)) or die("Not able to make insert request for article");
        }
    }


    public function loadArticle($id)
    {
        $sql = "select * from article where id = :id";
        $pdo = $this->pdoConnector->getPdo();
        $sth = $pdo->prepare($sql);
        // TODO: execute or die neni dobry postup, odchydni vyjimku / vyres stav statementu - tohle se ti tady obecne prolina, vratim se k tomu v obecnem textu
        $sth->execute(["id" => $id])  or die ("Not able to load article");
        if ($sth->rowCount() == 0) {
            throw new \RuntimeException("Article with this id does not exists");
        }
        $data = $sth->fetchAll();

        return new Article($this->pdoConnector, $data[0][0], $data[0][1], $data[0][2], $data[0][3], $data[0][4]);
    }


    public function deleteArticle($id)
    {
        $article = $this->loadArticle($id);

        if ($_SESSION["userId"] == $article->getIdUser() || $_SESSION["Rights"]) {
            $sql = "DELETE FROM article WHERE article.Id = :id";
            $pdo = $this->pdoConnector->getPdo();
            $sth = $pdo->prepare($sql);
            $sth->execute(["id" => $id]) or die("Not able to delete article");
        }

    }

    /**
     * @return mixed
     */
    public function getMaxPages()
    {
        return $this->maxPages[0];
    }


}

