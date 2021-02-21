<?php 
    class ItemsController{
        public function actionProduct()
        {
            //unset($_SESSION['compare']);
            $productsForCompare = array();
            $productsForCompare = Cart::getProductsForCompare();
            if ($productsForCompare) {
                $productsIds = array_keys($productsForCompare);
                $products = Product::getProductByIds($productsForCompare);
            }
            echo json_encode($products);
            return true;
         
        
        }
        public function actionCompare($id)
        {
            Cart::addProductCompare($id);
            echo Cart::countCompareItem();
            return true;
        }
        public function actionDelete($id)
        {
            if(isset($_SESSION['compare'])){
                Cart::deleteCompareProduct($id);
                $productsForCompare = array();
                $productsForCompare = Cart::getProductsForCompare();
                if ($productsForCompare) {
                    $productsIds = array_keys($productsForCompare);
                    $products = Product::getProductByIds($productsForCompare);
                    echo json_encode($products);  
                }
                return true;

            }
            header("Location: / ");
        }
    }


?>