<?php

trait AppController{
    public function getNewObject($string)
    {
        $className = ucfirst($string);
        return new $className();
    }
}