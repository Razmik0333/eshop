<?php  
class Order extends Product
{
    const STATUS_VALUE = 0;
    public $tableName = "orders";
    public $requiredFields = ['id','user_name','user_phone','user_comment','user_price', 'user_order', 'user_status'];
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
    public function getOrderById($id)
    {
        if($id){
            //echo $id;
            return $this->findFieldById($this->tableName, ['id' => $id],$this->requiredFields,$this->count)[0];
        }
        return false;
    }
    public function getOrderList()
    {
        return $this->findFields($this->tableName, $this->requiredFields, null);

    }
    public function getUserOrders()
    {

        return $this->getRows($this->tableName, 'user_order');

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
    public function deleteOrderById($id)
    {
        $this->deleteFieldById($this->tableName, ['id' => $id]);
        return true;
    }    
    public function updateOrder($id, $arrayOfField)
    {

        $this->updateFieldById($this->tableName,[
            'user_name' => $arrayOfField['user_name'],
            'user_phone' => $arrayOfField['user_phone'],
            'user_order' => $arrayOfField['user_order'],
            'user_comment' => $arrayOfField['user_comment'],            
            'user_status' => $arrayOfField['user_status'],            
        ], ['id' => $id]);
        return true;
    }

}