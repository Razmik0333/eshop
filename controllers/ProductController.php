<?php
    class ProductController 
    {
        use AppController;
        public function __construct()
        {
            $this->obj = $this->getNewObject('product');
        }

        public function actionView($filename,$productId)
        {
            
            $arrStyle = ['bootstrap.min','fonts','email',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','category','email',$filename];
            $fileScript = Page::getScripts($arrScripts); 
            $productById = $this->obj->getProductById($productId);
            //$a = "template/images/$productId.png";

           // echo $a;
            //var_dump(Product::getImage($a));
            //$category_1 = $productById['category'];
            //$category_2 = $productById['category_id'];
            ///$selectedCategory = Category::getCategoriesById($category_1,$category_2);
            require_once(ROOT.'/views/product/'.$filename.'.php');//подключение файлов системы
            return true;
        }

    }    

?>