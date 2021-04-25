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

        public function queryExecute($sql,$fieldsForBind = null)
        {
            return $this->query($sql, $fieldsForBind);

        }

        public function queryFetch($sql,$fieldsForBind = [], $fieldsForResult= [])
        {
            $smt = $this->query($sql, $fieldsForBind);
            $res = $this->getArrayOfGivenFields($smt,$fieldsForResult);

            return $res;
        }

        private function query($sql, $fieldsForBind)
        {
            $smt = $this->db->prepare($sql); 
            if ($fieldsForBind === null) {
                 $smt->execute();
            }else{
                 $this->getObjectForBind($smt,$fieldsForBind)->execute();
            }
            return $smt;
        }

        private function getObjectForBind($obj,$fields=[])
        {
            if($obj && $fields){
                foreach ($fields as $key => $field) {
                    $this->getBind($obj,$key,$field);
                }
                return $obj;
            }
            return false;
        }
        private function getBind($obj, $key,$field)
        {
           return $obj->bindParam(":$key", $field,PDO::PARAM_STR);
        }
        public function getArrayOfGivenFields($smt,$fields)
        {
            $i = 0;
            $fieldsList = [];
            while ($row = $smt->fetch()) {
                foreach ($fields as $key => $value) {
                    $fieldsList[$i][$fields[$key]] = $row[$fields[$key]];
                }
                $i++;
            }
            return $fieldsList;
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