<?php 
    class Cart
    {
        public static function addProduct($id)
        {
            $id = intval($id);
            $productsInCart = array();
            if (isset($_SESSION['products'])) {
                $productsInCart = $_SESSION['products'];
            }
            if (array_key_exists($id, $productsInCart)) {
                $productsInCart[$id] ++ ;
            }else{
                $productsInCart[$id] = 1;
            }
            $_SESSION['products'] = $productsInCart;
           
            return self::countItem();

        }
        public static function countItem()
        {
            if (isset($_SESSION['products'])) {
                $count = 0;
                foreach ($_SESSION['products'] as $id => $quantity) {
                    $count = $count + $quantity;
                }
                return $count;
            }else{
                return 0;
            }
        }
        public static function getProducts()
        {
            if (isset($_SESSION['products'])) {
                return $_SESSION['products'];
            }
            return false;
        }
        public static function deleteProduct($id)
        {
            if (isset($_SESSION['products'])) {
                unset($_SESSION['products'][$id]);
            }
            return true;
        }
        public static function clear()
        {
            unset($_SESSION['products']);
            return true;

        }
        public static function getTotalPrice($products)
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
        public static function addProductCompare($id)
        {
            //if (isset($_SESSION['compare'])) {

                $id = intval($id);
                if(count($_SESSION['compare']) < 3){
                    $_SESSION['compare'][$id] = $id;
                    
                    return $_SESSION['compare']; 
                }
            //}
            return false;

        }
        public static function getProductsForCompare()
        {
            if (isset($_SESSION['compare'])) {
                return $_SESSION['compare'];
            }
            return false;
        }
        public static function countCompareItem()
        {
            if (isset($_SESSION['compare'])) {
                return count($_SESSION['compare']);
            }
            return 0;
        }
        public static function deleteCompareProduct($id)
        {
            if (isset($_SESSION['compare'])) {
                unset($_SESSION['compare'][$id]);
            }
            return true;
        }
    }


?>