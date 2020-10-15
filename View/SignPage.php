<?php


namespace View;


use Data\Data;
use Navigation;

require_once "SharedBlocks/Navigation.php";

class SignPage implements View
{

    public function requireTemplate(array $data)
    {
        $css = "<link rel='stylesheet' href='/CSS/GlobalStyles.css' type='text/css'>
                <link rel='stylesheet' href='/CSS/Navigation.css' type='text/css'>
                <link rel='stylesheet' href='/CSS/SignPage.css' type='text/css'>";
        $js = "";
        $nav = new Navigation();
        $nav = $nav->returnTemplate();

        $head = "<!DOCTYPE html>
                    <html lang=\"en\">
                        <head><meta charset=\"UTF-8\">
                            <title>Forum</title>$css $js</head>";
        $body = "<body> $nav";
        $loginBlock = "<div class='loginBlock'>
                        <form method='post' action='/SignPage/login'>
                            <ul>
                                <li><label>Name:</label><input type='text' name='name'></li>
                                <li><label>Password:</label><input type='password' name='password'></li> 
                                <li><button>Login</button></li>
                            </ul>
                        </form>
                    </div>";
        $delimiterBox = "<div class='delimiterBlock'></div>";
        $registerBlock = "<div class='registerBlock'>
                            <form method='post' action='/SignPage/register'>
                                <ul>
                                    <li><label>Name</label><input type='text' name='name'></li>
                                    <li><label>Surname</label><input type='text' name='surname'></li>
                                    <li><label>Email</label><input type='text' name='email'></li>
                                    <li><label>NickName</label><input type='text' name='nickName'></li>
                                    <li><label>Password</label><input type='password' name='password'></li>
                                    <li><label>Password again</label><input type='password' name='passwordAgain'></li>
                                    <li><button>Register</button></li>
                                </ul>
                            </form>
                          </div>";
        $footer = "<footer></footer>";

        $body .= "$loginBlock $delimiterBox $registerBlock $footer";

        return "$head $body";
    }
}