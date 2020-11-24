<?php
namespace SharedBlocks;


class Navigation
{


    public function returnTemplate()
    {


        $nav = "<div class='navigation'>
                    <nav>
                        <ul>
                            <li><a href='/HomePage'>Homepage</a></li>";
        if (isset($_SESSION["userId"])) {
            if ($_SESSION["Rights"] == 0) {
                $nav .= "<li><a href='/AdministrationPage'>Administrace</a></li>";
            }
            $nav .= "<li><a href='/SignPage/logout'>Logout</a></li>";
        } else {
            $nav .= "<li><a href='/SignPage'>Sign Up</a></li>";
        }
        $nav .= "</ul></nav></div>";
        return $nav;
    }

}


?>