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
        public function actionProductCount()
        {
            $productsForWishlist = false;
            $productsForWishlist = $this->wishlist->getProducts();
            if ($productsForWishlist) {
                echo json_encode(count($productsForWishlist));
            }
            else{
                echo 0;
            }
            return true;
        }

        public function actionDelete($id)
        {
            $this->wishlist->deleteProduct($id);
            $productsInWishlist = $this->wishlist->getProducts();
            if($productsInWishlist){
                //unset($_SESSION['wishlist']);
                $productsIds = array_keys($productsInWishlist);
                $productsIdsString = implode(',',$productsIds);
                $products = $this->getNewObject('product')->getProductByIds($productsIdsString);
                
                $countItem = $this->wishlist->countItem($products);
                echo json_encode($products);
            }else {
                echo json_encode('0');
            }
            return true;
        }

        public function actionWishlist()
        {
            
            $productsInWishlist = false;
            $productsInWishlist = $this->wishlist->getProducts();
            if($productsInWishlist){
                //unset($_SESSION['wishlist']);
                $productsIds = array_keys($productsInWishlist);
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