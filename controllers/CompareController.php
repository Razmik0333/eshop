<?php

    class CompareController
    {       
        public function actionAdd($id)
        {
            Cart::addProductCompare($id);
            $refferer = $_SERVER['HTTP_REFERER'];
            header("Location: $refferer ");
            return true;
        }
        // public function actionAddAjax($id)
        // {
        //     echo count(Cart::addProductCompare($id));
        //     return true;
        // }
        public function actionDelete($id)
        {
            Cart::deleteCompareProduct($id);
            header("Location: /compare/items ");
            return true;
        }
        public function actionIndex($filename)
        { 
            $arrStyle = ['bootstrap.min','fonts',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','category',$filename];
            $fileScript = Page::getScripts($arrScripts); 
            require_once(ROOT.'/views/catalog/'.$filename.'.php');//подключение файлов системы
            return true;
        }
    }    

?>