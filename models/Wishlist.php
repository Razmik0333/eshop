<?php 

    class Wishlist extends Schedule
    {
        public $sessionName = 'wishlist';

        public function addProduct($id)
        {
            $id = intval($id);
            $_SESSION[$this->sessionName][$id] = $id;
            return $this->countItem();  
        }

    }