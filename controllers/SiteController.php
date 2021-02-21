<?php
    class SiteController
    {
        public function actionIndex($filename)
        {
            if ($filename == '' || $filename =='index.php') {
                $filename = 'home';
            }
            $arrStyle = ['bootstrap.min','fonts','email',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','category','email',$filename,'cart','rating'];
            $fileScript = Page::getScripts($arrScripts);
            require_once(ROOT."/views/site/".$filename.".php");//подключение файлов системы
            return true;
        }

        public function actionContact()
        {
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            $userEmail = false;
            $userText = false;
            $result = false;
            if(isset($_POST['submit'])){
                $userEmail = $_POST['userEmail'];
                $userText = $_POST['userText'];
                $errors = false;
                if(!User::checkEmail($userEmail)){
                    $errors[] = 'Неправилный email';
                }
                if($errors == false){
                    $adminEmail = 'razmik0333@gmail.com';

                    $message = "Текст: {$userText}.От {$userEmail} ";
                    $subject = 'Тема писма';
                    $result = mail($adminEmail, $subject, $message);

                    $result = true;
                }
            }
            require_once(ROOT.'/views/site/contact.php');
            return true;
        }        
    }    

?>