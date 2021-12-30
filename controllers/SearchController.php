<?php
    class SearchController
    {
        use AppController;
        public function actionIndex($filename)
        {
            $arrStyle = ['bootstrap.min','fonts','rating','email','site',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['functions','category','email',$filename,'cart','rating'];
            $fileScript = Page::getScripts($arrScripts);
            $arrModules = ['Connect','Tag','Links','TagWithTextContent','BaseMethods','Form','Input','Img',
            'modal/ModalWindow','modal/ModalEvent','CategoryBar','home/ProductCard','home/HomeEvent','home/RecomendCard','Pagination'];
            $fileModules = Page::getModules($arrModules);
            $scripts = ['public/category','public/smartSearch','public/search'];
            $fileScripts = Page::getModules($scripts);
            $productsLists = array();
            if(isset($_GET['search'])){
                    $_SESSION['search-field'] = $_GET['search-field'];
                   
            }
            require_once(ROOT."/views/catalog/".$filename.".php");//подключение файлов системы
            return true;
        }
        
    }    

?>