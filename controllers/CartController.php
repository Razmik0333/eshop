<?php 
    class CartController
    {

        public  function actionAdd($id,$count)
        {

            Cart::addProduct($id,$count);
            $refferer = $_SERVER['HTTP_REFERER'];
            header("Location: $refferer ");
            return true;

        }
        public function actionDelete($id)
        {
            Cart::deleteProduct('products',$id);
            header("Location: /cart/list ");
            return true;

        }
        public function actionAddAjax($id)
        {
            
            echo Cart::addProduct($id);
            return true;

        }


        public function actionIndex($filename)
        {
            $arrStyle = ['bootstrap.min','fonts','rating',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','email','functions','category',$filename];
            $fileScript = Page::getScripts($arrScripts);
                      
            require_once(ROOT.'/views/cart/'.$filename.'.php');//подключение файлов системы
            return true;
        }
    }


?>