<?php
    class MainController
    {
        public function actionIndex()
        {
            $productsLists = array();
            $productsLists = Product::getProductList(1);
            echo json_encode($productsLists);
            return true;
        }
        public function actionRecomend()
        {
            $recomendProductsLists = array();
            $recomendProductsLists = Product::getRecomendProducts(3);
            echo json_encode($recomendProductsLists);
            return true;
        }
        public function actionMaxdiscount()
        {
            $productDiscount = Product::getDiscountMax();
            $productDiscount = $productDiscount['max'];
            $productsMax= Product::getProductFromDiscount($productDiscount);
            echo json_encode($productsMax);
            return true;
        }
        
        public function actionSearch($str)
        {
            $productsLists = array();
            $productsLists = Product::getProductByStr($str, 1);          
            echo json_encode($productsLists);# code...
            return true;

        }
    }    

?>