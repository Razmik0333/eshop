<?php

    class WishlistItemController
    {
        use AppController;
        public $wishlist;  
        public $sessionName;
        public $className = 'wishlist';
        public function __construct()
        {
            $this->wishlist = $this->getNewObject($this->className);
            $this->sessionName = $this->wishlist->sessionName;
        }
        public function actionAdd($id)
        {
            echo $this->wishlist->addProduct($id);

            return true;
        }
        public function actionList($id)
        {
            echo $this->wishlist->addProduct($id);

            return true;
        }

        public function actionDelete(Type $var = null)
        {
            echo 'wish delete';
            return true;
        }

        public function actionWishlist()
        {
            
            $productsInCart = false;
            $productsInCart = $this->wishlist->getProducts();
            if($productsInCart){
                //unset($_SESSION['wishlist']);
                $productsIds = array_keys($productsInCart);
                $productsIdsString = implode(',',$productsIds);
                $products = $this->getNewObject('product')->getProductByIds($productsIdsString);
                
                $countItem = $this->wishlist->countItem($products);
                echo json_encode($products);
            }else {
                echo json_encode('0');
            }
            return true;
        }
    }