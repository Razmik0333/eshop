<?php 

class GoodsController 
{
    use AppController;
    public function actionIndex()
    {   
        $productsLists = array();
        $productsLists = $this->getNewObject('product')->getAllProductList();
        echo json_encode($productsLists);
        return true;
    }
    public function actionSearch($str)
    {   
        $productsLists = array();
        $productsLists = $this->getNewObject('product')->getProductByStr($str);
        echo json_encode($productsLists);
        
        return true;
    }
    public function actionBase()
    {   
        $productsLists = array();
        $searchField = $_SESSION['search-field'];
        if(strlen($searchField) > 0){
            $productsLists = $this->getNewObject('product')->getProductByStr($searchField);

        } else{
            $productsLists = 'Արդյունք չի գտնվել';
        }

        echo json_encode($productsLists);
        
        return true;
    }
}

?>