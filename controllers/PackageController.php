<?php 
    class PackageController
    {
        public function actionData()
        {
            $userId = $_SESSION['user'];
            $userOrders = Order::getOrdersById($userId);
            echo json_encode($userOrders);
            return  true;
        }
        public function actionProduct($str)
        {
            $userOrders = Product::getProductByIdsString($str);
            echo json_encode($userOrders);
            return true;
        }
    }


?>