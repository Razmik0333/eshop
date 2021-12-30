<?php

    class WishlistController
    {
        public function actionIndex($filename)
        {
            $arrStyle = ['bootstrap.min','fonts','rating','home',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','email','functions','category','wishlist'];
            $fileScript = Page::getScripts($arrScripts);
            $arrModules = ['classes/Connect','classes/BaseMethods','classes/Tag','classes/TagWithTextContent','classes/Form','classes/Links','classes/Input','classes/Img','classes/CategoryBar','classes/home/ProductCard','classes/WishlistCard'];
            $fileModules = Page::getScripts($arrModules);         
            require_once(ROOT.'/views/wishlist/'.$filename.'.php');//подключение файлов системы
            return true;
        }
        
    }