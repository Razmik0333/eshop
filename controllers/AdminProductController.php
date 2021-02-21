<?php

    class AdminProductController extends AdminBase
    {
        public function actionIndex($page = 1)
        {
            self::checkAdmin();
            $productList = array();
            $productList = Product::getProductList($page);
            require_once(ROOT.'/views/admin_product/index.php');//подключение файлов системы
            return true;
        }               
        public function actionCreate()
        {
            self::checkAdmin();
            $categoryList = array();
            $categoryList = Category::getCategoryList();
           
            if (isset($_POST['submit'])) {
                $options['category'] = $_POST['category'];
                $options['category_id'] = $_POST['category_id'];
                $options['item_name'] = $_POST['item_name'];
                $options['cost'] = $_POST['cost'];
                $options['discount'] = $_POST['discount'];
                $options['is_recommended'] = $_POST['is_recommended'];
                $options['availabile'] = $_POST['availabile'];
                $options['main'] = $_POST['main'];
                $options['code'] = $_POST['code'];
            }

            $errors = false;
            if (!isset($options['item_name']) || empty($options['item_name'])) {
                $errors[] = 'Наполните поле';
            }
            if(!$errors){
                $id = Product::createProduct($options);
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/template/images/{$id}.jpg");
                    }
                };
                header('Location: /admin/product');
            }
            
            require_once(ROOT.'/views/admin_product/create.php');//подключение файлов системы
            return true;
        }               
        public function actionUpdate($id)
        {
            self::checkAdmin();
            $categoryList = Category::getCategoryList();
            $product = Product::getProductById($id);
            if (isset($_POST['submit'])) {
                $options['category'] = $_POST['category'];
                $options['item_name'] = $_POST['item_name'];
                $options['cost'] = $_POST['cost'];
                $options['discount'] = $_POST['discount'];
                $options['new_cost'] = $options['cost']*(1 - $_POST['discount']/100);
                $options['is_recommended'] = $_POST['is_recommended'];
                $options['availabile'] = $_POST['availabile'];
                $options['main'] = $_POST['main'];
                $options['code'] = $_POST['code'];

                if(Product::updateProduct($id, $options)){
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/template/images/{$id}.jpg");
                    }
                }
                header('Location: /admin/product');    
            }        
                require_once(ROOT.'/views/admin_product/update.php');//подключение файлов системы
                return true;
        }               
        public function actionDelete($id)
        {
            self::checkAdmin();
            if(isset($_POST['submit'])){
                Product::deleteProductById($id);
                header('Location: /admin/product');
            }

            require_once(ROOT.'/views/admin_product/delete.php');//подключение файлов системы
            return true;
        }               
    }    

?>