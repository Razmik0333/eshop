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
            $arrModules = ['Connect','Tag','Links','TagWithTextContent','BaseMethods','Form','Input','Img',
            'modal/ModalWindow','modal/ModalEvent','CategoryBar','home/ProductCard','FilterProducts','Catalog','Pagination'];
            $fileModules = Page::getModules($arrModules);
            $scripts = ['public/category','public/smartSearch',"public/$filename"];
            $fileScripts = Page::getModules($scripts);
            require_once(ROOT."/views/catalog/".$filename.".php");//подключение файлов системы
            return true;
        }
        public function actionCategory($filename,$alias)
        { 
            $arrStyle = ['bootstrap.min','fonts','goods','rating','email',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','category','functions','email','cart',$filename];
            $fileScript = Page::getScripts($arrScripts);
            $arrModules = ['Connect','Tag','Links','TagWithTextContent','BaseMethods','Form','Input','Img',
            'modal/ModalWindow','modal/ModalEvent','CategoryBar','home/ProductCard','FilterProducts','Pagination'];
            $fileModules = Page::getModules($arrModules);
            $scripts = ['public/category','public/smartSearch',"public/$filename"];
            $fileScripts = Page::getModules($scripts);
            $_SESSION['alias'] = $alias;
            $cost_max= $this->getNewObject('product')->getTotalProducts($alias,'max');
            $cost_min= $this->getNewObject('product')->getTotalProducts($alias,'min');
            require_once(ROOT."/views/catalog/".$filename.".php");//подключение файлов системы
            return true;
            
        }
    }
?>