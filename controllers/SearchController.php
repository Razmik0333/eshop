<?php
    class SearchController
    {
        public function actionIndex($filename,$page)
        {
            //echo 'pg'.$page;
            $arrStyle = ['bootstrap.min','fonts',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','category','filter'];
            $fileScript = Page::getScripts($arrScripts);
            $productsLists = array();
            if(isset($_POST['search'])){
                $str = $_POST['search-field'];
                $productsLists = Product::getProductByStr($str,1);
            }
            
            
            require_once(ROOT."/views/catalog/".$filename.".php");//подключение файлов системы
            return true;
        }
        
    }    

?>