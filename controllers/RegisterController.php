<?php 

    class RegisterController{
        public function actionCheck($email)
        {
            echo json_encode(User::checkEmailExists($email));
            return true;
        }

        public function actionLog($login)
        {
            echo json_encode(User::checkLoginExists($login));
            return true;
        }
        public function actionRegister()
        {
            $login = $_POST['login'];
            $password = password_hash($_POST['password']);            ;
            $email = $_POST['email'];
            $name = $_POST['name'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $zip = $_POST['zip']; 
            echo json_encode(User::register($login,$password,$email,$name,$country,$city,$zip));
            return true;
        }
        public function actionLogin()
        {
            $password = $_POST['password']; 
            $email = $_POST['email'];
            $userId = User::checkUserData($email, $password);
            if ($userId) {
                User::auth($userId);
                echo json_encode($userId);
                return true;
            }else{
                $userId = 0;
                echo json_encode($userId);
                return false;
            }
        }

        public function actionGuest()
        {
            echo json_encode(User::isGuest());
            return true;
        }



    }

?>