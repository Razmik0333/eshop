<?php

class Compare extends Schedule {
    public $sessionName = 'compare';
    public function addProduct($id)
    {
        $id = intval($id);
        if(count($_SESSION[$this->sessionName]) < 3){
            $_SESSION[$this->sessionName][$id] = $id;
            
            return $_SESSION[$this->sessionName]; 
        }
        return false;

    }
    public static function getCompareArray($arr)
    {
        $arrIds = array_keys($arr);
        $arrIdsString = implode(',',$arrIds);
        return $arrIdsString;
    }
}
?>