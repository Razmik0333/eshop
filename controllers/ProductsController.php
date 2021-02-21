<?php

    class ProductsController
    {        
        public function actionAjaxProduct($str)
        {
            $productList = Product::getProductList(10);
            echo json_encode($productList);
            return true;
        }
        
    }    

?>