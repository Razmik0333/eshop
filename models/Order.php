<?php  
class Order extends Product
{
    const STATUS_VALUE = 0;
    public $tableName = "orders";
    public $requiredFields = ['user_price', 'user_order', 'user_status'];
    public $orderList;
    public $count;
    public function save($arrOrder)
    {
        return $this->insertField($this->tableName,$arrOrder);  
    }
    public function getOrdersCount($id)
    {
        $this->count = $this->getCountField($this->tableName,['user_id'=> $id]);
        return $this->count;
    }
    public function getOrdersById($id)
    {
        if($id){
            //echo $id;
            return $this->findFieldById($this->tableName, ['user_id' => $id],$this->requiredFields,$this->count);
        }
        return false;
    }


    public static function getOrderById($id)
    {
        if($id){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM orders WHERE `id` = :id ';
            $result = $db->prepare($sql);
            $result->bindParam('id',$id,PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();                
            return $result->fetch();
        }
    }
    public static function updateOrderStatus($id,$status)
    {
        if($id){
            $db = Db::getConnection();
            $sql = 'UPDATE orders SET status = :status WHERE `id` = :id';
            $result = $db->prepare($sql);
            $result->bindParam('id',$id,PDO::PARAM_INT);
            $result->bindParam('status',$status,PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->execute();    
        }
    }
    public static function deleteOrderById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM orders WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();        
    }    

    public static function getOrderList()
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM orders';
        $result = $db->prepare($sql);
        $result->execute();                
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function saveDataToArray($orders)
    {
        $arr = array();
        foreach($orders as $key => $order){
            $arr[$key] = $order;
        }
        return $arr;
    }
    public static function getOrderStatus($orders)
    {
        $arr = array();
        foreach($orders  as $order){
            $arr[] = Order::getOrderText($order['status']);
        }
        return $arr;
    }
    public static function jsonDecode($orders)
    {
        $arr = array();
        foreach($orders as  $order){
            $arr[] = Order::saveDataToArray(json_decode($order["products"]));
        }
        return $arr;
    }
    public static function getKeyToArray($array)
    {
        $arr = array();
        foreach($array as  $value){
            $arr[] = array_keys($value);
        }

        return $arr;
    }
    public static function getValuesToArray($array)
    {
        $arr = array();
        foreach($array as  $value){
            $arr[] = array_values($value);
        }
        return $arr;
    }
    public static function getOrdersProducts($array)
    {
        $arr = array();
        foreach($array as  $value){
            $arr[] = Product::getProductByIds($value);
        }

        return $arr;
    }
    public static function getPrice($orders, $costs)
    {
        $totalPrice = array();
        foreach($orders as $key => $order){
            $total = 0;
            foreach ($order as $key1 => $value) {
               $total += $value['cost'] * $costs[$key][$key1];
                                   
            }$totalPrice[] = $total;
        }

        return $totalPrice;
    }

    public static function getOrderText($status)
    {
        switch ($status) {
            case '0':
                return 'Պատվերն ընդունված է։';
                break;
            case '1':
                return 'Պատվերն ուղարկված է պատվիրատուին։';
                break;
            case '2':
                return 'Պատվերն հասել է պատվիրատուին։';
                break;
        }
    }
}
?>