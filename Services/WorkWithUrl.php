<?php

class WorkWithUrl
{
    // TODO: tohle nemas nikde pouzite?
    public static function getAtributesFromUrl()
    {
        $self = $_SERVER['REQUEST_URI'];
        $self = rtrim($self, "/"); // <--- mohlo by způsobovat problémy, dával by se do metod další parametr a to prázdný string ""
        $self = explode("/", $self);

        $args = array();

        if (count($self) > 2) {


            for ($i = 3; $i < count($self); $i++) {
                $args[] = $self[$i];
            }
        }
        return $args;
    }

    public static function getMethodFromUrl()
    {
        $self = $_SERVER['REQUEST_URI'];
        $self = rtrim($self, "/"); // <--- mohlo by způsobovat problémy, dával by se do metod další parametr a to prázdný string ""
        $self = explode("/", $self);


        $method = "";
        if (count($self) > 2) {
            $method = "$self[2]";
        }


        return $method;
    }
}