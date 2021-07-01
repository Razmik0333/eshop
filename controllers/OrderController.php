<?php
    class OrderController
    {
        public function actionIndex($filename)
        {
            $arrStyle = ['bootstrap.min','fonts','rating','home'];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','category','email',$filename];
            $fileScript = Page::getScripts($arrScripts);
            
            require_once ROOT."/views/catalog/$filename.php";//подключение файлов системы
            return true;
        }
    }    

?>