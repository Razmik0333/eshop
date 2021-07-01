<?php 
abstract class Schedule{
    public $sessionName = 'products';
    public function countItem()
    {
        if (isset($_SESSION[$this->sessionName])) {
            return count($_SESSION[$this->sessionName]);
        }
        return 0;
    }
    public function deleteProduct($id){
        if (isset($_SESSION[$this->sessionName])) {
            unset($_SESSION[$this->sessionName][$id]);
        }
        return true;
    }
    public function clear($str)
    {
        unset($_SESSION[$str]);
        return true;
    }
    public function getProducts()
    {
        if (isset($_SESSION[$this->sessionName])) {
            return $_SESSION[$this->sessionName];
        }
        return false;
    }
}?>