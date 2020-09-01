<?php


namespace View;


use Data\Data;


class User implements View
{

    /**
     * @inheritDoc
     */
    public function requireTemplate(array $data)
    {

        $loginForm = "<form action='User/login' method='post'>
                        <label>Name: </label><input type='text' name='userName'>
                        <label>Password: </label><input type='password' name='password'>
                        <button type='submit'>Přihlásit se</button></form>";
        $homePageBtn = "";
        if (isset($_SESSION["userId"])) {
            $homePageBtn = "<form action='HomePage' method='post'><button>HomePage</button></form>";
        }


        return "<html><header></header><body>$loginForm $homePageBtn</body></html>";
    }
}