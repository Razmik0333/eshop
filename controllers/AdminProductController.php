<?php

    class AdminProductController extends AdminBase
    {
        use AppController;
        public function actionIndex()
        {
            self::checkAdmin();
            $productList = array();
            $productList = $this->getNewObject('product')->getProductList();
            //Page::showArray($productList);
            $arrStyle = ['bootstrap.min','fontawesome.min','email','admin/product'];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','admin/product'];
            $fileScript = Page::getScripts($arrScripts);
            require_once(ROOT.'/views/admin_product/index.php');//подключение файлов системы
            return true;
        }               
        public function actionCreate()
        {
            self::checkAdmin();

            $id = $this->getNewObject('product')->createProduct($_POST);
            if ($id) {
                // Проверим, загружалось ли через форму изображение*/
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/template/images/$id.jpg");
                }
               echo json_encode(true);
                return true;
            }
            return false;
        }  


        public function actionItem($id)
        {
            $product = $this->getNewObject('product')->getProductById($id);
            echo json_encode($product);
            return true;
        }
           
                     
        public function actionUpdate($id)
        {
            self::checkAdmin();
            $isUpdate = $this->getNewObject('product')->updateProduct($id, $_POST);
            echo json_encode($isUpdate);
            return true;
        }       
        
        public function actionDelete($id)
        {
            self::checkAdmin();
            $isDelete = $this->getNewObject('product')->deleteProductById($id);
            echo json_encode($isDelete);
            return true;
        }               
    }    

?>