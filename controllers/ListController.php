<?php

    class ListController
    {       
        use AppController;
        public $cart;  
        public $sessionName;
        public $className = 'cart';
        public function __construct()
        {
            $this->cart = $this->getNewObject($this->className);
            $this->sessionName = $this->cart->sessionName;
        }



        public function actionCart($id,$count)
        {
            echo $this->cart->addProduct($id,$count);
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
                $adminEmail = 'razmik0333@gmail.ru';
                $message = '<a href="http://eshopoop.com/orders">Список заказов</a>';
                $subject = 'Новый заказ!';
                mail($adminEmail, $subject, $message);
                // Очищаем корзину
                echo json_encode($this->getNewObject('order')->save($_POST));
            }
            return true;
        }
        public function actionProductCount(){
            //unset($_SESSION['products']);

            $productsInCart = false;
            $productsInCart = $this->cart->getProducts();
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
            $productsInCart = $this->cart->getProducts();
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
        public function actionTotalprice()
        {
            $productsInCart = false;
            $productsInCart = $this->cart->getProducts();
            if($productsInCart){
                $productsIds = array_keys($productsInCart);
                $productsIdsString = implode(',',$productsIds);

                $products = $this->getNewObject('product')->getProductByIds($productsIdsString);
                $totalPrice = $this->cart->getTotalPrice($products);
                echo json_encode($totalPrice);
            }
            return true;
        }
        public function actionDelete($id)
        {
            //echo $id;
            $productsInCart = false;
            
            $this->cart->deleteProduct($id);
            $productsInCart = $this->cart->getProducts();
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
           $this->cart->clear($this->sessionName);
            echo json_encode('1');
            return true;
        }
    }
?>