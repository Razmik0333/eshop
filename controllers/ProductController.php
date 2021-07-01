<?php
    class ProductController 
    {
        public function actionView($filename,$productId)
        {
            $arrStyle = ['bootstrap.min','fonts','rating','email',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','category','email','cart',$filename];
            $fileScript = Page::getScripts($arrScripts); 
            //$productById = $this->obj->getProductById($productId);
            $_SESSION['productId'] = $productId;
            require_once(ROOT.'/views/product/'.$filename.'.php');//подключение файлов системы
            return true;
        }

    }    

?>