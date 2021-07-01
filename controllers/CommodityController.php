<?php 

    class CommodityController {
        use AppController;
        public function __construct()
        {
            $this->obj = $this->getNewObject('product');
        }
        public function actionProduct()
        {
            $productId = $_SESSION['productId'];
            $productById = $this->obj->getProductById($productId);
            $productById['url'] = Product::getImage($productId);
            echo json_encode($productById);
            return true;
        }
        public function actionProductCount()
        {
            $orderList = $this->getNewObject('order')->getUserOrders();
            echo json_encode($orderList);
            return true;
        }


    }