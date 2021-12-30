<?php
    class ProductController 
    {
        public function actionView($filename,$productId)
        {
            $arrStyle = ['bootstrap.min','fonts','rating','email',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','category','email','cart',$filename];
            $fileScript = Page::getScripts($arrScripts); 
            $arrModules = ['Connect','Tag','Links','TagWithTextContent','BaseMethods','Form','Input','Img',
            'modal/ModalWindow','modal/ModalEvent','CategoryBar','ProductPage'];
            $fileModules = Page::getModules($arrModules);
            $scripts = ['public/category','public/smartSearch'];
            $fileScripts = Page::getModules($scripts);
            //$productById = $this->obj->getProductById($productId);
            $_SESSION['productId'] = $productId;
            require_once(ROOT.'/views/product/'.$filename.'.php');//подключение файлов системы
            return true;
        }

    }    

?>