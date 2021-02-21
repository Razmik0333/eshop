<?php

    class AdminCategoriesController extends AdminBase
    {
        public function actionIndex()
        {
            self::checkAdmin();
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            // var_dump($categoryList);
            require_once(ROOT.'/views/admin_categories/index.php');//подключение файлов системы
            return true;
        }               
        public function actionCategory($id)
        {
            self::checkAdmin();
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            $categoryListById = array();
            $categoryListById = Category::getCategoryAllList($id);
            require_once(ROOT.'/views/admin_categories/category.php');//подключение файлов системы
            return true;
        }               
        public function actionCreate()
        {
            self::checkAdmin();
           
            if (isset($_POST['submit'])) {
                $options['name'] = $_POST['name'];
                $options['category'] = $_POST['category'];
                $options['category_id'] = $_POST['category_id'];
            }

            $errors = false;
            if (!isset($options['category']) || empty($options['category'])) {
                $errors[] = 'Наполните поле';
            }
            if(!$errors){
                Category::createCategoriesItem($options);
                header('Location: /admin/categories');
            }
            require_once(ROOT.'/views/admin_categories/create.php');//подключение файлов системы
            return true;
        }               
        public function actionUpdate($id,$category,$category_id)
        {
            self::checkAdmin();
            $categoriesById = Category::getCategoriesById($category,$category_id);
             if (isset($_POST['submit'])) {
                 $options['name'] = $_POST['name'];
                 $options['id'] = $_POST['id'];
                 $options['category'] = $_POST['category'];
                 $options['category_id'] = $_POST['category_id'];
                 Category::updateCategoriesItem($id,$options);
                 header('Location: /admin/categories');    
            }        
                require_once(ROOT.'/views/admin_categories/update.php');//подключение файлов системы
                return true;
        }           
        public function actionDelete($id)
        {
            self::checkAdmin();
            if(isset($_POST['submit'])){
                Category::deleteCategoriesById($id);
                header('Location: /admin/categories');
            }
            require_once(ROOT.'/views/admin_categories/delete.php');//подключение файлов системы
            return true;
        }               
    }    

?>