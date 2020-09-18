<?php


namespace View;


use Data\Data;

class HomePage implements View
{

    /**
     * @param Data[] $data
     * @return mixed|string
     */
    public function requireTemplate(Array $data)
    {


        $css = "<link rel='stylesheet' href='/CSS/HomePage.css' type='text/css'>";

        $js = "<script src='/JS/homePage.js'></script>";

        $head = "<head>$css.$js</head>";
        $logoutBtn = "";
        $form = "";

        if (isset($_SESSION['userId'])) {

            $form = "<div><form action='/HomePage/sendNew' method='post'>
                        <label>Napiš title:</label><input type='text' name='title'>
                        <label>Napiš Příspěvek: </label><textarea name='text'></textarea>
                        <button name='prispevek' type='submit'>Odeslat</button>
                        </form></div>";

            $logoutBtn = "<form method='post' action='/User/logout'><button name='logout'>Logout</button></form>";
        } else {
            $logoutBtn = "<form method='post' action='/User'><button name='login'>Login</button> </form>";
        }

        $articles = "<div class='articles'>";


        for ($i = 0; $i < count($data); $i++) {
            $articles .= "<div class = 'article'>";
            $articles .= "<div class='title'> title: " . $data[$i]->getTitle() . "</div>";
            $articles .= "<div class='text'> text: " . $data[$i]->getText() . "</div>";
            if (isset($_SESSION['userId'])) {
                $articles .= '<button onclick="showAddCommentBlock(' . $data[$i]->getId() . ')">Okomentovat</button>';
                $articles .= "<div class='commentForm' id='addCommentBlock-" . $data[$i]->getId() . "'><form action='/HomePage/addComment/" . $data[$i]->getId() . "' method='post'>
                            <label>Komentar: </label><input type='text' name='commentText'>
                            <button>Odeslat komentář</button>
                            </form></div>";
            }
            $commentsCount = count($data[$i]->getComments());
            if ($commentsCount > 0) {
                $commentBlock = "<div class='comments'>";
                for ($l = 0; $l < $commentsCount; $l++) {
                    $comment = $data[$i]->getComments()[$l];
                    $commentBlock .= "<div class='comment'>";
                    $commentBlock .= "<div class='commentText'>" . $comment->getText() . "</div>";
                    $commentBlock .= "<div class='commentUser'>" . $comment->getIdUser() . "</div>";

                    $commentBlock .= "</div>";
                }

                $commentBlock .= "</div>";
                $articles .= $commentBlock;
            }
            $articles .= "</div>";
        }

        $articles .= "</div";


        $body = "<body>$logoutBtn $form $articles</body>";
        $footer = "";
        $template = "<html>" . $head . $body . $footer . "</html>";
        return $template;
    }
}