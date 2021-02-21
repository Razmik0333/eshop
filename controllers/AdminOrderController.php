<?php

    class AdminOrderController extends AdminBase
    {
        public function actionIndex()
        {
            self::checkAdmin();
            $orderList = array();
            $orderList = Order::getOrderList();
            require_once(ROOT.'/views/admin_order/index.php');
            return true;
        }                            
        public function actionUpdate($id)
        {
            self::checkAdmin();
            //$categoryList = Category::getCategoryList();
            $orderById = Order::getOrderById($id);
            $order = $orderById['products'];
            $order = json_decode($order);
            $order = Order::saveDataToArray($order);
            $orderIDs = array_keys($order);
            $orderCounts = array_values($order);
            $orders = Product::getProductByIds($orderIDs);
            if (isset($_POST['submit'])) {
            
                 $status = $_POST['status'];
                 Order::updateOrderStatus($id,$status);
                header('Location: /admin/order');    
             }       

                require_once(ROOT.'/views/admin_order/update.php');//подключение файлов системы
                return true;
        }               
        public function actionDelete($id)
        {
            self::checkAdmin();
            if(isset($_POST['submit'])){
                Order::deleteOrderById($id);
                header('Location: /admin/order');
            }

            require_once(ROOT.'/views/admin_order/delete.php');//подключение файлов системы
            return true;
        }              
    }    

?>