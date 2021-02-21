<?php

    class ListController
    {        
        public function actionCategory(){
            $categoryList = array();
            $categoryList = Category::getCategoryList();
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
                $dataByUser = User::getUserById($id);
                echo json_encode($dataByUser);
            }else {
                echo json_encode(0);
            }
            return true;
        }
        public function actionBuy()
        {
            if (isset($_POST)) {
                $userId = $_POST['id'];
                $userName = $_POST['name'];  
                $userPhone = $_POST['phone']; 
                $userComment = $_POST['comment'];
                $userOrder = $_POST['order'];
                $userPrice = $_POST['price'];
                echo json_encode(Order::save($userId, $userName, $userPhone, $userComment, $userOrder,$userPrice));
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
                $products = Product::getProductByIds($productsIds);
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
                $products = Product::getProductByIds($productsIds);
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
                $products = Product::getProductByIds($productsIds);
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