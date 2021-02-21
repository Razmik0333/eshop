<?php 
    class FilterController
    {
       public function actionProduct()
       {
            $alias = $_SESSION['alias'];
            $categoryProducts = Product::getProductsInCategory($alias);
            echo json_encode($categoryProducts);
            return true;
       }
       public function actionProducts()
       {
            $categoryProducts = Product::getProductList();
            echo json_encode($categoryProducts);
            return true;
       }
      
    }


?>