<?php

    class CatalogController 
    {
        public function actionIndex($filename,$page = 1)
        {
            $arrStyle = ['bootstrap.min','fonts','email','goods',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','category','email',$filename,'cart'];
            $fileScript = Page::getScripts($arrScripts);

            require_once(ROOT."/views/catalog/".$filename.".php");//подключение файлов системы
            return true;
        }
        public function actionCategory($filename,$alias, $page = 1)
        { 
             
            $arrStyle = ['bootstrap.min','fonts','goods','email',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','category','email',$filename];
            $fileScript = Page::getScripts($arrScripts);
            $_SESSION['alias'] = $alias;
            $cost_max = Product::getMaxMinCost($alias,'max');
            $cost_min = Product::getMaxMinCost($alias,'min');
            require_once(ROOT."/views/catalog/".$filename.".php");//подключение файлов системы
            return true;
            
        }
         
            public function actionCategoryfilter($categoryId, $categoryFilterId, $page = 1)
            {
                $uri = $_SERVER['REQUEST_URI']; 
  
                if(strpos($uri,"?") !== false){
                    $uriArr = explode('?', $uri);
                    // echo $uriArr[0];

                    $arr_gets = explode('&',$uriArr[1]);
                    $arr = array();
                    $arrGets = array();
                    foreach ($arr_gets as $arr_get) {
                        $arr = explode('=',$arr_get);
                        $arrGets[$arr[0]] = $arr[1];
                    }                
                } 
                $categoryList = array();
                $categoryList = Category::getCategoryList();
                $categoryFilterLists = array();
                $categoryFilterLists = Category::getCategoryAllList($categoryId);
                $categoryFilterProducts = Product::getProductsFilterListByCategory($categoryId, $categoryFilterId, $page, $isFavorite = false,$isNew=false,$isCheap = false,$price_min = false,$price_max =false);
                $total = Product::getFilterProductsInCategory($categoryId, $categoryFilterId,$isFavorite = false,$isNew=false,$isCheap = false,$price_min = false,$price_max =false);

                if(isset($arrGets['highest'])){
                   $isFavorite = intval($arrGets['highest']);
                   $categoryFilterProducts = Product::getProductsFilterListByCategory($categoryId, $categoryFilterId, $page, $isFavorite,$isNew=false,$isCheap = false,$price_min = false,$price_max =false);
                   $total = Product::getFilterProductsInCategory($categoryId,$categoryFilterId, $isFavorite,$isNew=false,$isCheap = false,$price_min = false,$price_max =false);

               }elseif(isset($arrGets['newest'])){
                  $isNew =intval( $arrGets['newest']);
                  $categoryFilterProducts = Product::getProductsFilterListByCategory($categoryId, $categoryFilterId, $page , $isFavorite=false, $isNew,$isCheap = false,$price_min = false,$price_max =false);
                  $total = Product::getFilterProductsInCategory($categoryId, $categoryFilterId,$isFavorite=false, $isNew,$isCheap = false,$price_min = false,$price_max =false);

              }
              elseif(isset($arrGets['cheap'])){
                  $isCheap = intval($arrGets['cheap']);
                  $categoryFilterProducts = Product::getProductsFilterListByCategory($categoryId, $categoryFilterId, $page , $isFavorite = false, $isNew = false,$isCheap,$price_min = false,$price_max =false);
                  $total = Product::getFilterProductsInCategory($categoryId,$categoryFilterId,$isFavorite = false, $isNew = false,$isCheap,$price_min = false,$price_max =false);
              }
              elseif(isset($arrGets['price-min']) || isset($arrGets['price-max'])){
                 $price_min = $arrGets['price-min'];
                 $price_max = $arrGets['price-max'];
                 $categoryFilterProducts = Product::getProductsFilterListByCategory($categoryId, $categoryFilterId, $page , $isFavorite = false, $isNew = false,$isCheap = false, $price_min,$price_max);
                 $total = Product::getFilterProductsInCategory($categoryId,$categoryFilterId,$isFavorite = false,$isNew=false,$isCheap=false,$price_min,$price_max);
             }
                $pagination = new Pagination($page, Product::SHOW_BY_DEFAULT, $total);
                if(isset($_POST['list'])){
                    $list = $_POST['list'];
                    Product::saveToSession('view',$list);
                }
                elseif(isset($_POST['grid'])){
                    $grid = $_POST['grid'];
                    Product::saveToSession('view',$grid);
                }
                if(Product::getFromSession('view') == 'list'){
                    require_once(ROOT.'/views/catalog/category-list.php');  //подключение файлов системы
                }else{
                    require_once(ROOT.'/views/catalog/category.php');  //подключение файлов системы
                }
                
                return true;
              }
        
     }    

?>