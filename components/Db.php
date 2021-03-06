<?php
    class Db
    {
        protected static $instance;
        private $params = [];
        private $db;
        public function __construct()
        {
            $paramsPath = ROOT.'/config/db_params.php';
            $this->params = include($paramsPath);
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ];
            $dsn = "mysql:host={$this->params['host']};dbname={$this->params['dbname']}";
            $this->db = new PDO($dsn, $this->params['user'], $this->params['password'],$options);
        }
        public function queryFetch($sql,$fields = [])
        {
            $smt = $this->db->prepare($sql);
            $smt = \Db::getObjectForBindParam($smt,$fields);
            $smt->execute();
            $res = \Db::getArrayOfGivenFields($smt,$fields);
            return $res;
        }
        public function queryFetchStr($sql, $fields = [])
        {
            
        }
        public static function getObjectForBindParam($obj,$fields=[])
        {
            if($obj && $fields){
                foreach ($fields as $key => $field) {
                    $obj->bindParam(":$field",$field,PDO::PARAM_STR);
                }
                return $obj;
            }
            return false;
        }

        public static function getArrayOfGivenFields($smt,$fields)
        {
            $i = 0;
            while ($row = $smt->fetch()) {
                foreach ($fields as $key => $value) {
                    $categoryList[$i][$fields[$key]] = $row[$fields[$key]];
                }
                $i++;
            }
            return $categoryList;
        }
        protected static function returnInstance()
        {
            if (self::$instance === null) {
                self::$instance = new self;
            }
            return self::$instance;

        }
    }
    
?>