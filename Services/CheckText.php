<?php


namespace Services;


class CheckText
{
    // TODO: obecne statiku nemam rad, tohle nemusis upravovat, ale ber to jako doporuceni
    // TODO: lepsi mit v pameti instanci tohodle validatoru a predavat ho jako zavislost tam, kde je potreba
    public static function allowTags($text)
    {
        $text = strip_tags($text, '<br><strong><a><p><pre><code>');
        return $text;
    }
}