<?php

    class AdminCategoryController extends AdminBase
    {
        use AppController;
        public function actionIndex()
        {
            self::checkAdmin();
            $categoryList = $this->getNewObject('category')->getCategories();
            //Page::showArray($productList);
            $arrStyle = ['bootstrap.min','fontawesome.min','email','admin/category'];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','admin/category'];
            $fileScript = Page::getScripts($arrScripts);
            require_once(ROOT.'/views/admin_category/index.php');//подключение файлов системы
            return true;
        }               
        public function actionCreate()
        {
            self::checkAdmin();
            $id = $this->getNewObject('category')->createCategory($_POST);
            echo json_encode($id);
            return true;
        }               
        public function actionUpdate($id)
        {
            self::checkAdmin();
            $isUpdate = $this->getNewObject('category')->updateCategory($id, $_POST);
            echo json_encode($isUpdate);
            return true;
        }             
        public function actionDelete($id)
        {
            self::checkAdmin();
            $isDelete = $this->getNewObject('category')->deleteCategoryById($id);
            echo json_encode($isDelete);
            return true;
        }      
        public function actionItem($id)
        {
            $category = $this->getNewObject('category')->getCategoryById($id);
            echo json_encode($category);
            return true;
        }          
    }    

?>