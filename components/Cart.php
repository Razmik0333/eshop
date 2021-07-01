<?php 
    class Cart extends Schedule
    {
        public function addProduct($id,$count)
        {
           // echo $count;
            $id = intval($id);
            $productsInCart = array();
            if (isset($_SESSION[$this->sessionName])) {
                $productsInCart = $_SESSION[$this->sessionName];
            }
            if (array_key_exists($id, $productsInCart)) {
                $productsInCart[$id] += $count ;
            }else{
                $productsInCart[$id] = $count;
            }
            $_SESSION[$this->sessionName] = $productsInCart;
           //var_dump($_SESSION['products']);
            return $this->countItem();

        }
        public function countItem()
        {
            if (isset($_SESSION[$this->sessionName])) {
                $count = 0;
                foreach ($_SESSION[$this->sessionName] as $id => $quantity) {
                    $count = $count + $quantity;
                }
                return $count;
            }else{
                return 0;
            }
        }
        
        public  function getTotalPrice($products)
        {
            $productsInCart = self::getProducts();
            $total = 0;
            if($productsInCart){
                foreach ($products as $item) {
                    $total += $item['cost'] * $productsInCart[$item['id']];
                }
            }
            return $total;
        }
        
    }


?>