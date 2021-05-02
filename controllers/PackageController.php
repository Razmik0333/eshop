<?php 
    class PackageController extends AppController
    {
        public function actionData()
        {
            $userId = $_SESSION['user'];
            $userOrders = $this->getNewObject('order')->getOrdersById($userId);
            //var_dump($userOrders);
            echo json_encode($userOrders);
            return  true;
        }
        public function actionProduct($str)
        {

            $userOrders = $this->getNewObject('product')->getProductByIds($str);
            echo json_encode($userOrders);
            return true;
        }
    }


?>