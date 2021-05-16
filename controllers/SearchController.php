<?php
    class SearchController extends AppController
    {
        public function actionIndex($filename)
        {
            //echo 'pg'.$page;
            $arrStyle = ['bootstrap.min','fonts',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','category','filter'];
            $fileScript = Page::getScripts($arrScripts);
            $productsLists = array();
            if(isset($_POST['search'])){
                $str = $_POST['search-field'];
                $productsLists = $this->getNewObject('product')->getProductByStr($str);          
            }
            
            
            require_once(ROOT."/views/catalog/".$filename.".php");//подключение файлов системы
            return true;
        }
        
    }    

?>