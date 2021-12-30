<?php

    class CompareController
    {       
        public function actionAdd($id)
        {
            Compare::addProductCompare($id);
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
            Compare::deleteCompareProduct($id);
            header("Location: /compare/items ");
            return true;
        }
        public function actionIndex($filename)
        { 
            $arrStyle = ['bootstrap.min','fonts',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','category','email',$filename];
            $fileScript = Page::getScripts($arrScripts); 
            $arrModules = ['classes/Connect','classes/BaseMethods','classes/Tag','classes/TagWithTextContent','classes/Form','classes/Links','classes/Input','classes/Img','classes/CategoryBar'];
            $fileModules = Page::getScripts($arrModules);
            require_once(ROOT.'/views/contents/'.$filename.'.php');//подключение файлов системы
            return true;
        }
    }    

?>