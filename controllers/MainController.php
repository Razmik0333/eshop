<?php
    class MainController
    {
         
        public function getProductObj()
        {
            return $productObj = new Product();
        }
        public function actionIndex()
        {
            $arr = $this->getProductObj()->getProductList();
            echo json_encode($arr);
            return true;
        }
        public function actionRecomend()
        {
            $recomendProductsLists = array();
            $recomendProductsLists = $this->getProductObj()->getRecomendProducts();
            //Page::showArray($recomendProductsLists);
            echo json_encode($recomendProductsLists);
            return true;
        }
        public function actionMaxdiscount()
        {
            $productDiscount = $this->getProductObj()->getDiscountMax();
            $productDiscount = $productDiscount['max'];
            $productsMax= $this->getProductObj()->getProductFromDiscount($productDiscount);
            echo json_encode($productsMax);
            return true;
        }
        
        public function actionSearch($str)
        {
            $productsLists = array();
            $productsLists = $this->getProductObj()->getProductByStr($str);          
            echo json_encode($productsLists);
            return true;

        }
    }    

?>