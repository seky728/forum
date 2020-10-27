<?php


namespace View;

use Navigation;

require_once("SharedBlocks/Navigation.php");


class AdministrationPage implements View
{

    /**
     * @inheritDoc
     */
    public function requireTemplate(array $data)
    {

        $css = "<link rel='stylesheet' href='/CSS/GlobalStyles.css' type='text/css'>
                <link rel='stylesheet' href='/CSS/Navigation.css' type='text/css'>
                <link rel='stylesheet' href='/CSS/AdministrationPage.css' type='text/css'>
                <link rel='stylesheet' href='/CSS/SignPage.css' type='text/css'>";

        $js = "<script src='/JS/AdministrationPage.js'></script>";


        $head = "<!DOCTYPE html>
                    <html lang=\"en\">
                        <head><meta charset=\"UTF-8\">
                            <title>Forum</title>$css </head>";
        $nav = new Navigation();
        $nav = $nav->returnTemplate();
        $divUsers = "";
        $tableUSers = "<table><thead><tr><th>Jméno</th><th>Příjmení</th><th>Email</th><th>Nickname</th><th>Rights</th><th>Rights Up</th><th>Rights Down</th></tr></thead><tbody>";

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]->getId() == $_SESSION["userId"]) {
                $divUsers .= "<div class='registerBlock'>
                            <form method='post' action='/AdministrationPage.php/editUser'>
                                <ul>
                                    <li><label>Name</label><input type='text' name='name' value='" . $data[$i]->getName() . "'></li>
                                    <li><label>Surname</label><input type='text' name='surname' value='" . $data[$i]->getSurname() . "'></li>
                                    <li><label>Email</label><input type='text' name='email' value='" . $data[$i]->getEmail() . "'></li>
                                    <li><label>NickName</label><input type='text' name='nickName' value='" . $data[$i]->getUserName() . "'></li>
                                    <li><label>Password</label><input type='password' name='password'></li>
                                    <li><label>Password again</label><input type='password' name='passwordAgain'></li>
                                    <li><button>Edit</button></li>
                                </ul>
                            </form>
                          </div>";
            } else {
                $rights = $data[$i]->getRights();
                switch ($rights) {
                    case 0:
                        $rights = "Admin";
                        break;
                    case 1:
                        $rights = "Editor";
                        break;
                    case 2:
                        $rights = "Aktivní přispěvovatel";
                        break;
                    case 3:
                        $rights = "Registrovaný uživatel";
                        break;
                }
                $tableUSers .= "<tr><td>" . $data[$i]->getName() . "</td><td>" . $data[$i]->getSurname() . "</td><td>" . $data[$i]->getEmail() . "</td><td>" . $data[$i]->getUserName() . "</td><td>" . $rights . "</td><td><a href='/AdministrationPage.php/rightsDown/" . $data[$i]->getId() . "'>Rights Up</a></td><td><a href='/AdministrationPage.php/rightsUp/" . $data[$i]->getId() . "'>Rights Down</a></td></tr>";
            }
        }
        $tableUSers .= "</tbody></table";

        $template = $head . $js . $nav . $divUsers . $tableUSers . "</html>";
        return $template;
    }
}