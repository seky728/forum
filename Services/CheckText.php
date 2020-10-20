<?php


namespace Services;


class CheckText
{
    static public function allowTags($text)
    {

        $text = strip_tags($text, '<br><strong><a><p><pre><code>');
        return $text;
    }
}