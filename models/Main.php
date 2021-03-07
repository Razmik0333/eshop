<?php 

abstract class Main extends Db
{
    public $pdo;
    public function __construct()
    {
        $this->pdo = \Db::returnInstance();
    }
    public function findFieldById($table, $arrayOfFields = [], $field)
    {
         $sql = "SELECT * FROM {$table} WHERE $field[0] = :$field[0]";

         $this->pdo->queryFetch($sql, $arrayOfFields,$field);
    }
    public function findFields($table, $arrayOfFields = [], $count = NULL)
    {
        $sql = "SELECT * FROM {$table}";
        $count !== null ?  $sql.=" LIMIT $count" : '';
        echo $sql;
        $arr = $this->pdo->queryFetch($sql, $arrayOfFields);
        return $arr;
    }
    public function findFieldsByStr($table,$field,$arrayOfFields = [],$str, $count)
    {
        $sql = "SELECT * FROM {$table} WHERE $field LIKE '%$str%' LIMIT $count";
        $arr = $this->pdo->queryFetch($sql, $arrayOfFields);
        return $arr;
    }
    public function findFieldsByIds($table,$field,$idsArray,$arrayOfFields=[])
    {
        $idsString = implode(',', $idsArray);
        $sql = "SELECT * FROM {$table} WHERE $field IN ($idsString)";
        $arr = $this->pdo->queryFetch($sql, $arrayOfFields);
        var_dump($arr);
        return $arr;
    }
    
}

?>