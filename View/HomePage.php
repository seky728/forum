<?php


namespace View;


use Data\Data;
use Navigation;
use SharedBlocks\ArticlesManagementMenu;

require_once "SharedBlocks/Navigation.php";
require_once "SharedBlocks/ArticlesManagementMenu.php";


class HomePage implements View
{


    /**
     * @param Data[] $data
     * @return mixed|string
     */
    public function requireTemplate(Array $data)
    {
        $articleMenu = new ArticlesManagementMenu();

        $css = "<link rel='stylesheet' href='/CSS/GlobalStyles.css' type='text/css'>
                <link rel='stylesheet' href='/CSS/Navigation.css' type='text/css'>
                <link rel='stylesheet' href='/CSS/HomePage.css' type='text/css'>";

       $js = "<script src='/JS/homePage.js'></script>";


        $head = "<!DOCTYPE html>
                    <html lang=\"en\">
                        <head><meta charset=\"UTF-8\">
                            <title>Forum</title>$css </head>";
        $logoutBtn = "";
        $form = "";
        $nav = new Navigation();
        $nav = $nav->returnTemplate();


        if (isset($_SESSION['userId'])) {

            $form = '<div class="newsForm"><form action="/HomePage/sendNew" method="post" onsubmit="return checkArticleNewForm()">
                        <div class="title">
                        <label>Napiš title:</label><input type="text" name="title">
                        </div>
                        <div class="text">
                        <label>Napiš Příspěvek: </label><textarea name="text"></textarea>
                         </div>
                        <button name="prispevek" type="submit">Odeslat</button>
                        </form></div>';
        }

        $articles = "<div class='articles'>";


        for ($i = 0; $i < count($data); $i++) {
            $articles .= "<div class = 'article'>";
            $articles .= "<div class = 'background'>";
            $articles .= "<div class='title'>" . $data[$i]->getTitle() . "</div>";
            if ((isset($_SESSION["Rights"]) && $_SESSION["Rights"] < 3) || (isset($_SESSION["userId"]) && $data[$i]->getIdUser() == $_SESSION["userId"])) {
                $articles .= $articleMenu->requireArticleMenu($data[$i]->getId());
            }
            $articles .= "<div class='text'>" . $data[$i]->getText() . "</div>";
            $articles .= "</div>";
            if (isset($_SESSION['userId'])) {
                $articles .= '<div class="articleButtons">';
                $articles .= '<div class="line"></div>';
                $articles .= '<button id="reportButton" onclick="reportArticle(' . $data[$i]->getId() . ')">Report</button>';
                $articles .= '<button id="commentButton" onclick="showAddCommentBlock(' . $data[$i]->getId() . ')">Okomentovat</button>';
                $articles .= '</div>';
                $articles .= "<div class='commentForm' id='addCommentBlock-" . $data[$i]->getId() . "'>
                <form action='/HomePage/addComment/" . $data[$i]->getId() . "' method='post' onsubmit='return checkComment(" . ($data[$i]->getId()) . ")'>
                            <input type='text' name='commentText'>
                            <button>Odeslat komentář</button>
                            </form></div>";
            }
            $commentsCount = count($data[$i]->getComments());
            if ($commentsCount > 0) {
                $articles .= '<div class="line"></div>';
                $commentBlock = "<div class='comments'>";
                for ($l = 0; $l < $commentsCount; $l++) {
                    $comment = $data[$i]->getComments()[$l];
                    $commentBlock .= "<div class='comment'>";
                    $commentBlock .= "<div class='commentUser' title='" . $comment->getTimeStamp() . "'>" . $comment->getAuthorName();
                    if ((isset($_SESSION["Rights"]) && $_SESSION["Rights"] < 3) || (isset($_SESSION["userId"]) && $comment->getIdUser() == $_SESSION["userId"])) {
                        $commentBlock .= $articleMenu->requireCommentMenu($comment->getId());
                    }
                    $commentBlock .= "</div>";
                    $commentBlock .= "<div class='commentText'>" . $comment->getText() . "</div>";

                    $commentBlock .= "</div>";
                }

                $commentBlock .= "</div>";
                $articles .= $commentBlock;
            }
            $articles .= "</div>";
        }

        $articles .= "</div>";


        $body = "<body>$nav $logoutBtn $form $articles</body>";
        $footer = "";
        $template = $head . $body . $footer . $js . "</html>";
        return $template;
    }
}