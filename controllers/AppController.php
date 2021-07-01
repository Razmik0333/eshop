<?php

trait AppController{
    public function getNewObject($string)
    {
        $className = ucfirst($string);
        return new $className();
    }
    public function getCount($className)
    {
        return $this->getNewObject($className)->countItem();
        
    }
}