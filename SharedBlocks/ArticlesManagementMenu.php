<?php


namespace SharedBlocks;


class ArticlesManagementMenu
{

    public function requireArticleMenu($id)
    {
        $arNav = "<ul>
                    <li><a href='/HomePage/deleteArticle/$id'>Odstranit</a></li>
                    <li><a href='/HomePage/editArticle/$id'>Upravit</a></li>
                </ul>";

        return $arNav;
    }

    public function requireCommentMenu($id)
    {
        $comMenu = "<ul>
                        <li><a href='/HomePage/deleteComment/$id'>Odstranit</a></li>
                        <li><a href='/HomePage/editComment/$id'>Upravit</a></li>
                    </ul>";

        return $comMenu;
    }

}