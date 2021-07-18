<?php

    class WishlistController
    {
        public function actionIndex($filename)
        {
            $arrStyle = ['bootstrap.min','fonts','rating','home',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','email','functions','category','wishlist'];
            $fileScript = Page::getScripts($arrScripts);
                      
            require_once(ROOT.'/views/wishlist/'.$filename.'.php');//подключение файлов системы
            return true;
        }
        
    }