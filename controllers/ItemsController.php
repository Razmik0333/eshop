<?php 
    class ItemsController{
        use AppController;
        public $compare;  
        public $sessionName; 
        public $className = 'compare';
 
        public function __construct()
        {
            $this->compare = $this->getNewObject($this->className);
            $this->sessionName = $this->compare->sessionName;
        }
        public function actionProduct()
        {
            //$this->compare = $this->getNewObject('compare');
            $productsForCompare = array();
            
            $productsForCompare = $this->compare->getProducts($this->sessionName);
            if ($productsForCompare) {
                $productsIdsString = Compare::getCompareArray($productsForCompare);
                $products = $this->getNewObject('product')->getProductByIds($productsIdsString);
                echo json_encode($products);
                
            }else{

                echo json_encode('0');
                
            }
            return true;
        }
        public function actionCompare($id)
        {

            $this->compare->addProduct($id);
            echo $this->compare->countItem($this->sessionName);
            return true;
        }
        public function actionDelete($id)
        {
            
            $this->compare->deleteProduct($id);
            $productsForCompare = array();
            $productsForCompare = $this->compare->getProducts($this->sessionName);
            if ($productsForCompare) {
                $productsIdsString = Compare::getCompareArray($productsForCompare);
                $products = $this->getNewObject('product')->getProductByIds($productsIdsString);
                echo json_encode($products);  
                return true;
            }
            echo json_encode('0');
            return true;
        }
        public function actionProductCount()
        {
            $productsInCart = false;
            $productsInCart = $this->compare->getProducts();
            if ($productsInCart) {
                echo json_encode(count($productsInCart));
            }
            else{
                echo 0;
            }
            return true;
        }
    }


?>