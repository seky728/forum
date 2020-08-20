<?php

namespace View;


use Data\Data;

interface View
{

    /**
     * @param Data[] $data
     * @return mixed
     */
    public function requireTemplate(Array $data);


}