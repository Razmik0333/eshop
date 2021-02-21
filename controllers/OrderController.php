<?php
    class OrderController
    {
        public function actionIndex($filename)
        {
            $arrStyle = ['bootstrap.min','fonts','home'];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','category','email',$filename];
            $fileScript = Page::getScripts($arrScripts);
            /*$categoryList = array();
            $categoryList = Category::getCategoryList();
            $userId = User::checkLogged();
            $orders = Order::getOrdersById($userId);
            $orderStatus = Order::getOrderStatus($orders);
            $userOrders =  Order::jsonDecode($orders);  
            $orders_arr = Order::saveDataToArray($userOrders);
            $ordersIds = Order::getKeyToArray($orders_arr);
            $ordersValues = Order::getValuesToArray($orders_arr);       
            $userOrders = Order::getOrdersProducts($ordersIds);
            $totalPrice = Order::getPrice($userOrders, $ordersValues);*/
            require_once ROOT."/views/catalog/$filename.php";//подключение файлов системы
            return true;
        }
    }    

?>