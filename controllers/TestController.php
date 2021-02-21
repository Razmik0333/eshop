<?php 
    class TestController{
        public function actionTest($filename)
        {
            if ($filename == '' || $filename =='index.php') {
                $filename = 'home';
            }
            $arrStyle = ['bootstrap.min','fonts','email',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','category','email',$filename];
            $fileScript = Page::getScripts($arrScripts);
            require_once(ROOT."/views/site/".$filename.".php");
            return true;

        }
    }


?>