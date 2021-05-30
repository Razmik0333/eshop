<?php

    class ListController
    {       
        use AppController;
        public function actionCategory(){
            $categoryList = array();
            $categoryList = $this->getNewObject('category')->getCategories();
            echo json_encode($categoryList);
            return true;
        }
        public static function actionCountItems()
        {
            echo json_encode(Cart::countItem().' '.Cart::countCompareItem());
            return true;
        }

        public function actionCart($id)
        {
            echo Cart::addProduct($id);
            return true;
        }
        public function actionData()
        {
            if(isset($_SESSION['user'])){
                $id = $_SESSION['user'];
                $dataByUser = $this->getNewObject('user')->getUserById($id);
                echo json_encode($dataByUser);
            }else {
                echo json_encode(0);
            }
            return true;
        }
        public function actionBuy()
        {
            if (isset($_POST)) {

                echo json_encode($this->getNewObject('order')->save($_POST));
            }
            return true;
        }
        public function actionProductCount(){
            $productsInCart = false;
            $productsInCart = Cart::getProducts();
            if ($productsInCart) {
                echo json_encode($productsInCart);
            }
            else{
                echo 0;
            }
            return true;
        }
        public function actionProduct(){
            $productsInCart = false;
            $productsInCart = Cart::getProducts();
            if($productsInCart){
                $productsIds = array_keys($productsInCart);
                $productsIdsString = implode(',',$productsIds);
                $products = $this->getNewObject('product')->getProductByIds($productsIdsString);
                
                $countItem = Cart::countItem($products);
                echo json_encode($products);
            }else {
                echo json_encode('0');
            }
            return true;
        }
        public function actionTotalprice()
        {
            $productsInCart = false;
            $productsInCart = Cart::getProducts();
            if($productsInCart){
                $productsIds = array_keys($productsInCart);
                $productsIdsString = implode(',',$productsIds);

                $products = $this->getNewObject('product')->getProductByIds($productsIdsString);
                $totalPrice = Cart::getTotalPrice($products);
                echo json_encode($totalPrice);
            }
            return true;
        }
        public function actionDelete($id)
        {
            //echo $id;
            $productsInCart = false;
            
            Cart::deleteProduct($id);
            $productsInCart = Cart::getProducts();
            if($productsInCart){
                $productsIds = array_keys($productsInCart);
                $productsIdsString = implode(',',$productsIds);

                $products = $this->getNewObject('product')->getProductByIds($productsIdsString);
                echo json_encode($products);
            }else {
                echo json_encode('0');
            }
            return true;
        }
        public function actionClear()
        {
           // echo 'clear';
            Cart::clear();
            echo json_encode('1');
            return true;
        }
    }
?>