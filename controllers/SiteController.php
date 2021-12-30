<?php
    class SiteController
    {
        public function actionIndex($filename)
        {
            echo $filename;
            if ($filename == '' || $filename =='index.php') {
                $filename = 'site';
            }
            //unset($_SESSION['user']);
            $arrStyle = ['bootstrap.min','fonts','rating','email','goods',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['functions','category','email',$filename,'cart','rating'];
            $fileScript = Page::getScripts($arrScripts);
            $arrModules = ['Connect','Tag','Links','TagWithTextContent','BaseMethods','Form','Input','Img',
            'modal/ModalWindow','modal/ModalEvent','CategoryBar','home/ProductCard','home/HomeEvent','home/RecomendCard','Pagination'];
            $fileModules = Page::getModules($arrModules);
            $scripts = ['public/category','public/smartSearch','public/products','public/recomend'];
            $fileScripts = Page::getModules($scripts);
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