<?php


namespace View;


use Data\Data;

class HomePage implements View
{

    public function requireTemplate(Data $data)
    {
        $head = "<head></head>";
        $form = "<div><form action='HomePage.php' method='post'>
                        <label>Napiš Příspěvek: </label><textarea name='prispevek'></textarea>
                        <button name='submit'>Odeslat</button>
                        </form></div>";
        $body = "<body>$form</body>";
        $footer = "";
        $template = "<html>" . $head . $body . $footer . "</html>";
        return $template;
    }
}