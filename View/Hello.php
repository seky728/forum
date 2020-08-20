<?php


namespace View;


use Data\Data;

class Hello implements View
{

    /**
     *
     * @return string
     */
    public function requireTemplate(Data $data)
    {
        return "<thml><p>This is my first templete so be nice plz</p></thml>";
    }
}