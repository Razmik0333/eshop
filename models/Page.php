<?php


class Page
{
    public static function getStyles($arr)
    {
        foreach ($arr as $value) {
            # code...
            $resource[] = "href='/template/style/${value}.css'";
        }
        return $resource;

    }
    public static function getScripts($arr)
    {
        $resource = '';
        foreach ($arr as $value) {
           // Page::showArray($value);

            $resource[] = "<script src='/template/script/${value}.js'></script>";
        }
        return $resource;
    }
    public static function getModules($arr)
    {
        $resource = [];
        foreach ($arr as $value) {
            $resource[] = "<script src='/template/script/classes/${value}.js' type='module'></script>";
        }
        return $resource;
    }
    
    public static function showArray($arr)
    {
        echo '<pre>';
        var_dump($arr);
        echo '</pre>';
    }
}

?>