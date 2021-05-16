<?php 

class GoodsController extends AppController
{
    public function actionIndex()
    {   

        $productsLists = array();
        $productsLists = $this->getNewObject('product')->getProductList();
        echo json_encode($productsLists);
        return true;
    }
    public function actionSearch($str)
    {   
        $productsLists = array();
        $productsLists = $this->getNewObject('product')->getProductByStr($str);
        echo  json_encode($productsLists);
        
        return true;
    }
}

?>