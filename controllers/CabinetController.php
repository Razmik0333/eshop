<?php

    class CabinetController 
    {
        //use AppController;
        public function actionIndex($filename)
        {
            $filename = $filename == '' ? "page" : $filename;
                
            if(!User::checkLogged()){
                header("Location: /home");

            }

            $arrStyle = ['bootstrap.min','fonts','email',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','category','email',$filename];
            $fileScript = Page::getScripts($arrScripts);
            require_once(ROOT."/views/cabinet/$filename.php");//подключение файлов системы

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