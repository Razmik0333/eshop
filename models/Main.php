<?php 

abstract class Main extends Db
{
    public $pdo;
    public function __construct()
    {
        $this->pdo = \Db::returnInstance();
    }

    //find fields from SELECT
    public function findFieldById($table, $arrayOfFields = [], $field,$count)
    {
        $sqlString = Main::createQueryForUpdate($arrayOfFields);
        $sql = "SELECT * FROM {$table} WHERE $sqlString ";
        $count == null ? $sql .= '' : $sql .= " ORDER BY id DESC LIMIT $count ";

        $arr = $this->pdo->queryFetch($sql, $arrayOfFields,$field);
        return $arr; 
    }
    public function findFields($table, $arrayOfFields = [], $count)
    {
        $sql = "SELECT * FROM {$table}";
        $count !== null ? $sql.=" LIMIT $count" : $sql .='';
        $arr = $this->pdo->queryFetch($sql, null, $arrayOfFields);
        return $arr;
    }
    public function findFieldsByStr($table,$field,$arrayOfFields = [],$str, $count)
    {
        $sql = "SELECT * FROM {$table} WHERE $field LIKE '%$str%' LIMIT $count";
        $arr = $this->pdo->queryFetch($sql,null, $arrayOfFields);
        return $arr;
    }
    public function findFieldsByIds($table,$field,$idsString,$arrayOfFields=[])
    {
        //$idsString = implode(',', $idsArray);
        $sql = "SELECT * FROM {$table} WHERE $field IN ($idsString)";
        $arr = $this->pdo->queryFetch($sql, null, $arrayOfFields);
        return $arr;
        
    }
    public function getMaxItem($str, $field,$minmax)  // get max item(discount, rating)
    {
        
        $minmaxToUpper = strtoupper($minmax);
        $sql = "SELECT  $minmaxToUpper($str) AS $minmax FROM products ";
        if ($field === null) {
           $sql .= "" ;
        } else {
            $sqlString = Main::createQueryForUpdate($field);
            $sql .= "WHERE $sqlString";
        }        
        $arr = $this->pdo->queryFetch($sql, $field,[$minmax]);
        return $arr[0];
    }
    public function getCountField($table,$field)
    {
        $sqlString = Main::createQueryForUpdate($field);
        //echo $sqlString;
        $sql = "SELECT COUNT(*) FROM $table WHERE $sqlString";
        return $this->pdo->queryExecute($sql, $field)->fetchColumn();

    }
    public function getRowsFromField($table, $arrayOfFields, $str)
    {
        $sqlString = Main::createQueryForUpdate($arrayOfFields);
        //echo $sqlString;
        $sql = "SELECT $str FROM {$table} WHERE $sqlString ";
        $arr = $this->pdo->queryFetch($sql, $arrayOfFields,[$str]);

        return $arr[0][$str];

    }
    public function getRows($table, $str)
    {
        $sql = "SELECT $str FROM {$table} ";
        $arr = $this->pdo->queryFetch($sql, null,[$str]);
        $arrayFromRows = Main::getArrayFromData($arr);
        return $arrayFromRows;

    }
    //find
    //delete fields from  DELETE
    public function deleteFieldById($table, $arrayOfId)
    {
        $sqlString = Main::createQueryForUpdate($arrayOfId);
        $sql = "DELETE FROM {$table} WHERE $sqlString";
        $res = $this->pdo->queryExecute($sql, $arrayOfId);
        return $res; 
    }
    //delete fields from  DELETE
    //update fields from  UPDATE

    public function updateFieldById($table,$arrayOfField,$arrayOfId)
    {
        $sqlStringId = Main::createQueryForUpdate($arrayOfId);
        $sqlString = Main::createQueryForUpdate($arrayOfField);
        $sql = "UPDATE {$table} SET $sqlString  WHERE $sqlStringId";
        $mergedArray = array_merge($arrayOfField,$arrayOfId); 

        $res = $this->pdo->queryExecute($sql, $mergedArray);
        return $res; 

    }
    //update fields from  UPDATE
    //insert fields from INSERT
    public function insertField($table, $arrayOfField)
    {
        $sqlString = $this->createQueryForInsert($arrayOfField);
        $sql = "INSERT INTO {$table} $sqlString";
        if ($this->pdo->queryExecute($sql, $arrayOfField)){
            return $this->pdo->getLastId();
        }
        return false;
    }
    //insert fields from INSERT
    public function createQueryForInsert($arrayOfFields = [])
    {
        $sqlStringOne = "";
        $sqlStringTwo = "";
        foreach ($arrayOfFields as $key => $value) {
            $sqlStringOne .= " $key,";
            $sqlStringTwo .= " :$key,";
        }
        return '('.substr($sqlStringOne, 0, -1) .') VALUES ('.substr($sqlStringTwo, 0, -1).')'; // delete last character ,
    }
    public static function createQueryForUpdate($arrayOfFields = [])
    {
        $sqlString = "";
        foreach ($arrayOfFields as $key => $value) {
            $sqlString .= "$key = :$key, ";
           
        }

        return substr($sqlString, 0, -2); // delete last character ,
        
    }
    public static function getArrayFromData($arr)
    {
        foreach ($arr as $k1 => $v1) {
            foreach ($v1 as $k2 => $v2) {
                $arrFromValues[] = $v2;
            }
        }
        return $arrFromValues;
    }
}

?>