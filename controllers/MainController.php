<?php
    class MainController
    {
        use AppController;
        public function actionIndex()
        {
            $arr = $this->getNewObject('product')->getProductList();
            echo json_encode($arr);
            return true;
        }
        public function actionRecomend()
        {
            $recomendProductsLists = array();
            $recomendProductsLists = $this->getNewObject('product')->getRecomendProducts();
            echo json_encode($recomendProductsLists);
            return true;
        }
        public function actionMaxdiscount()
        {
            $productDiscount = $this->getNewObject('product')->getDiscountMax();
            $productDiscount = $productDiscount['max'];
            $productsMax= $this->getNewObject('product')->getProductFromDiscount($productDiscount);
            echo json_encode($productsMax);
            return true;
        }
        
        public function actionSearch($str)
        {
            $productsLists = array();
            $productsLists = $this->getNewObject('product')->getProductByStr($str);          
            echo json_encode($productsLists);
            return true;

        }
    }    

?>