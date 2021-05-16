<?php
    class User extends Main
    {   
        public $tableName = 'user';

        public function register($arrOfData)
        {     
            $arrOfData['password'] = password_hash($arrOfData['password'],PASSWORD_DEFAULT); 
            $this->insertField($this->tableName,$arrOfData);  
            return true;
        }
        public function getName($id)
        {
           return $this->getFieldValue($this->tableName,['id' => $id], 'name');
        }

        public static function checkEmail($email)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                return true;
            }
            return false;
        }
        public function checkEmailExists($email)
        {
           $status = $this->getCountField($this->tableName,['email'=>$email]) == 1 ? true : false;
            return $status;

        }
        public function checkLoginExists($login)
        {
            $login = $this->getCountField($this->tableName,['login'=>$login]) == 1 ? true : false;
            return $login;
        }
        
        public function checkUserData($email,$password)
        {
            $user = $this->findFieldById($this->tableName,['email'=>$email],['id','login','password'],1)[0];
            if (password_verify($password,$user['password'])) {
                return $user['id'];
            }
            return false;
        }
        public static function auth($userId)
        {
            $_SESSION['user'] = $userId;
        }
        public static function checkLogged()
        {
            if(isset($_SESSION['user'])){
                return $_SESSION['user'];
            }
           // header("Location: /home");
            return false;
        }
        public function isUser()
        {
            if(isset($_SESSION['user'])){
                $id = $_SESSION['user'];
                $user = $this->getUserById($id)[0];
                return $user;
            }
            return false;
        }
        public function getUserById($id)
        {
            if($id){
                $user = $this->findFieldById($this->tableName,['id'=>$id],['id','login','name','role'],1);
                return $user;
            }
            return false;
        }
        public static function edit($id,$name, $password)
        {
            $db = Db::getConnection();
            $sql = "UPDATE users SET `name` = :name, `password` = :password  WHERE id = :id";
            $result = $db->prepare($sql);
            $result->bindParam(':id',$id,PDO::PARAM_INT);
            $result->bindParam(':name',$name,PDO::PARAM_STR);
            $result->bindParam(':password',$password,PDO::PARAM_STR);
            return $result->execute();
        }

    }
?>