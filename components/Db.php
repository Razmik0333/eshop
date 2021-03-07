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
        public function queryFetch($sql,$fieldsForBind = null, $fieldsForResult= [])
        {
            $smt = $this->db->prepare($sql);
            // if ($fieldsForBind === []) {
            //     $smt = \Db::getObjectForBindParam($smt,$fieldsForBind);
                
            // }
            $smt->execute();
            $res = \Db::getArrayOfGivenFields($smt,$fieldsForResult);
            Page::showArray($res);
            return $res;
        }
        public static function getObjectForBindParam($obj,$fields=[])
        {
            if($obj && $fields){
                foreach ($fields as $key => $field) {
                    $obj->bindParam(":$key", $field,PDO::PARAM_STR);
                }
                var_dump($obj);
                return $obj;
            }
            return false;
        }

        public static function getArrayOfGivenFields($smt,$fields)
        {
            $i = 0;
            $categoryList = [];
            while ($row = $smt->fetch()) {
                foreach ($fields as $key => $value) {
                    echo $value;

                    $categoryList[$i][$fields[$key]] = $row[$fields[$key]];
                }
                $i++;
            }
            
            var_dump($categoryList);
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