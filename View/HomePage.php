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


        $css = "<link rel='stylesheet' href='CSS/HomePage.css' type='text/css'>";

        $head = "<head>$css</head>";
        $logoutBtn = "";
        $form = "";

        if (isset($_SESSION['userId'])) {


            $form = "<div><form action='HomePage' method='post'>
                        <label>Napiš title:</label><input type='text' name='title'>
                        <label>Napiš Příspěvek: </label><textarea name='text'></textarea>
                        <button name='prispevek' type='submit'>Odeslat</button>
                        </form></div>";

            $logoutBtn = "<form method='post' action='User/logout'><button name='logout'>Logout</button></form>";
        } else {
            $logoutBtn = "<form method='post' action='User'><button name='login'>Login</button> </form>";
        }

        $articles = "<div class='articles'>";


        for ($i = 0; $i < count($data); $i++) {
            $articles .= "<div class = 'article'>";
            $articles .= "<div class='title'> title: " . $data[$i]->getTitle() . "</div>";
            $articles .= "<div class='text'> text: " . $data[$i]->getText() . "</div>";
            $articles .= "</div>";
        }

        $articles .= "</div";


        $body = "<body>$logoutBtn $form $articles</body>";
        $footer = "";
        $template = "<html>" . $head . $body . $footer . "</html>";
        return $template;
    }
}