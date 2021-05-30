<?php

    class AdminController extends AdminBase
    {
        public function actionIndex()
        {
            $this->checkAdmin();
            $arrStyle = ['bootstrap.min','fonts','font-awesome','email','index'];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','functions','category','email','index'];
            $fileScript = Page::getScripts($arrScripts);
            require_once(ROOT.'/views/admin/index.php');//подключение файлов системы

            return true;
        }               
    }    

?>