<?php 
    class FeatureController
    {
        public function actionProduct()
        {
            $otherProductsLists = array();
            $otherProductsLists = Product::getRecomendProducts(4);
            echo json_encode($otherProductsLists);
            return true;
        }
    }


?>