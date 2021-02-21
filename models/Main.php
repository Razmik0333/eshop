<?php 

abstract class Main 
{

    public static function getProductById($id,$sql)
    {
        $db = Db::getConnection();
        $result = $db->prepare($sql);
    }
}

?>