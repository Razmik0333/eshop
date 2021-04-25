<?php 
    class FilterController extends AppController
    {

       public function actionProduct()
       {
            $alias = $_SESSION['alias'];
            //echo $alias;
            $categoryProducts = $this->getNewObject('product')->getProductsInCategory($alias);
            echo json_encode($categoryProducts);
            return true;
       }
      
    }


?>