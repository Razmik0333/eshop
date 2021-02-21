<?php

    class CabinetController extends AdminBase
    {
        public function actionIndex()
        {
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            $userId = User::checkLogged();
            // echo $userId;
            $user = User::getUserById($userId);
            require_once(ROOT.'/views/cabinet/index.php');//подключение файлов системы

            return true;
        }        
        public function actionEdit()
        {
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $name = $user['name'];
            $password = $user['password'];
            $result = false;
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $password = $_POST['password'];
                echo $password ;
                $errors = false;
                if(!User::checkName($name)){
                    $errors[] = 'Имя не может иметь меньше 3-х символов';
                }
                if(!User::checkPassword($password)){
                    $errors[] = 'Пароль не может иметь меньше 6-и символов';
                }
                if($errors == false){
                    $result = User::edit($userId, $name, $password);
                }
            }
            require_once(ROOT.'/views/cabinet/edit.php');//подключение файлов системы

            return true;

        }        
    }    

?>