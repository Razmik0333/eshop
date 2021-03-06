<?php 

abstract class Main extends Db
{
    public $pdo;
    public function __construct()
    {
        $this->pdo = \Db::returnInstance();
    }
    public function findFieldById($id, $field, $arrayOfFields = [])
    {
         $sql = "SELECT * FROM {$table} WHERE $field = :$field";
         $this->pdo->queryFetch($sql, $arrayOfFields);
    }
    public function findFields($table, $arrayOfFields = [], $count = NULL)
    {
        $sql = "SELECT * FROM {$table}";
        $count !== null ?  $sql.=" LIMIT $count" : '';
        $arr = $this->pdo->queryFetch($sql, $arrayOfFields);
        return $arr;
    }
    public function findFieldsByStr($table,$field,$arrayOfFields = [],$str, $count)
    {
        $sql = "SELECT * FROM {$table} WHERE $field LIKE '%$str%' LIMIT $count";
        $arr = $this->pdo->queryFetch($sql, $arrayOfFields);
        return $arr;
    }
    
}

?>