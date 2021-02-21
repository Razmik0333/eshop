<?php
class UserController
    {   
        public function actionRegister()
        {
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            $name = '';
            $email = '';
            $password = '';
            if (isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $errors = false;

                if(!User::checkName($name)){
                    $errors[] = 'Имя не может иметь меньше 3-х символов';
                }
                if(!User::checkEmail($email)){
                    $errors[] = 'Неправильный email';
                }
                if(!User::checkPassword($password)){
                    $errors[] = 'Пароль не может иметь меньше 6-и символов';
                }
                if(User::checkEmailExists($email)){
                    $errors[] = 'Такой email уже используется';
                }
                if ($errors == false) {
                    $result = User::register($name, $email,$password);
                }                
            }
            require_once(ROOT.'/views/user/welcome.php');//подключение файлов системы
            return true;
        }
        public function actionLogin()
        {
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            $email = '';
            $password = '';
            if (isset($_POST['submit']))
            {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $errors = false;

                if(!User::checkEmail($email)){
                    $errors[] = 'Неправильный email';
                }
                if(!User::checkPassword($password)){
                    $errors[] = 'Пароль не может иметь меньше 6-и символов';
                }
                $userId = User::checkUserData($email,$password);

                if($userId == false){
                    $errors[] = 'Неправильные данные для входа на сайт';
                }else {
                    User::auth($userId);
                    header('Location:/cabinet');
                }                
            }
            require_once(ROOT.'/views/user/login.php');//подключение файлов системы
            return true;
        }
        public function actionLogout()
        {
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            unset($_SESSION['user']);
            header("Location: /");
        }
        
    }  
?>