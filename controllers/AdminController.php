<?php

    class AdminController extends AdminBase
    {
        public function actionIndex()
        {
            self::checkAdmin();
            
            require_once(ROOT.'/views/admin/index.php');//подключение файлов системы

            return true;
        }               
    }    

?>