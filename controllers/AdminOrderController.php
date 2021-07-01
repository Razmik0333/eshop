<?php

    class AdminOrderController extends AdminBase
    { 
        use AppController;
        public function actionIndex()
        {
            self::checkAdmin();
            $orderList = array();
            $orderList = $this->getNewObject('order')->getOrderList();
            $arrStyle = ['bootstrap.min','fontawesome.min','email','admin/order'];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','admin/order'];
            $fileScript = Page::getScripts($arrScripts);
            require_once(ROOT.'/views/admin_order/index.php');
            return true;
        }   
        public function actionCreate(){
            self::checkAdmin();

            echo json_encode($this->getNewObject('order')->save($_POST));
            return true;
            //Page::showArray($_POST);
        }
                         
        public function actionItem($id)
        {
            self::checkAdmin();

            $orderById = $this->getNewObject('order')->getOrderById($id);
            echo json_encode($orderById);
            return true;
        }            
        public function actionUpdate($id)
        {
            self::checkAdmin();

            $orderById = $this->getNewObject('order')->updateOrder($id, $_POST);
            echo json_encode($orderById);
                return true;
        }            
        public function actionDelete($id)
        {
            self::checkAdmin();

            echo json_encode($this->getNewObject('order')->deleteOrderById($id));
            return true;
        }             
    }    

?>