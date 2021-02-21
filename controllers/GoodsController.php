<?php 

class GoodsController
{
    public function actionIndex($page)
    {   

        $productsLists = array();
        $productsLists = Product::getProductList($page);
        echo json_encode($productsLists);
        return true;
    }
    public function actionSearch($str)
    {   
        $productsLists = array();
        $productsLists = Product::getProductByStr($str,1);
        echo  json_encode($productsLists);
        
        return true;
    }
}

?>