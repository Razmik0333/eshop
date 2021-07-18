<?php

    class CatalogController 
    {
        use AppController;


        public function actionIndex($filename)
        {
            echo $filename;
            $arrStyle = ['bootstrap.min','fonts','email','rating','goods',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','category','email','cart',$filename];
            $fileScript = Page::getScripts($arrScripts);
            Page::showArray($arrScripts);
            require_once(ROOT."/views/catalog/".$filename.".php");//подключение файлов системы
            return true;
        }
        public function actionCategory($filename,$alias)
        { 
            $arrStyle = ['bootstrap.min','fonts','goods','rating','email',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','category','functions','email','cart',$filename];
            $fileScript = Page::getScripts($arrScripts);
            $_SESSION['alias'] = $alias;
            $cost_max= $this->getNewObject('product')->getTotalProducts($alias,'max');
            $cost_min= $this->getNewObject('product')->getTotalProducts($alias,'min');
            require_once(ROOT."/views/catalog/".$filename.".php");//подключение файлов системы
            return true;
            
        }
    }
?>