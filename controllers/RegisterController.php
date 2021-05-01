<?php 

    class RegisterController extends AppController{
        private $obj;
        public function __construct()
        {
            $this->obj = $this->getNewObject('user');
        }
        public function actionCheck($email)
        {
            echo json_encode($this->obj->checkEmailExists($email));
            return true;
        }

        public function actionLog($login)
        {
            echo json_encode($this->obj->checkLoginExists($login));
            return true;
        }
        public function actionRegister()
        {
            echo json_encode($this->getNewObject('user')->register($_POST));
            return true;
        }
        public function actionLogin()
        {
            $password = $_POST['password']; 
            $email = $_POST['email'];
            $userId = $this->obj->checkUserData($email, $password);
            //echo $userId;
            if ($userId) {
                User::auth($userId);
                echo $userId;
            }else{
                $userId = 0;
               echo json_encode($userId);
            }
            return true;
        }

        public function actionGuest()
        {
            echo json_encode(User::isGuest());
            return true;
        }



    }

?>