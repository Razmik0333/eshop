<?php

    class AdminCategoryController extends AdminBase
    {
        public function actionIndex()
        {
            self::checkAdmin();
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            require_once(ROOT.'/views/admin_category/index.php');//подключение файлов системы
            return true;
        }               
        public function actionCreate()
        {
            self::checkAdmin();
           
            if (isset($_POST['submit'])) {
                $options['category'] = $_POST['category'];
                $options['category_id'] = $_POST['category_id'];
            }

            $errors = false;
            if (!isset($options['category']) || empty($options['category'])) {
                $errors[] = 'Наполните поле';
            }
            if(!$errors){
                Category::createCategory($options);
                header('Location: /admin/category');
            }
            
            require_once(ROOT.'/views/admin_category/create.php');//подключение файлов системы
            return true;
        }               
        public function actionUpdate($id)
        {
            self::checkAdmin();
            $categoryById = Category::getCategoryById($id);
            if (isset($_POST['submit'])) {
                $options['category'] = $_POST['category'];
                $options['category_id'] = $_POST['category_id'];
                Category::updateCategory($id,$options);
                header('Location: /admin/category');    
            }        
                require_once(ROOT.'/views/admin_category/update.php');//подключение файлов системы
                return true;
        }               
        public function actionDelete($id)
        {
            self::checkAdmin();
            if(isset($_POST['submit'])){
                Category::deleteCategoryById($id);
                header('Location: /admin/category');


            }
            
            require_once(ROOT.'/views/admin_category/delete.php');//подключение файлов системы
            return true;
        }               
    }    

?>