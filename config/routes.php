<?php

return array(

        'test/test/([a-zA-Z0-9]+)' => 'test/test/$1',
        'admin/product/create' => 'adminProduct/create',
        'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
        'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
        'admin/product' => 'adminProduct/index',
        // Управление категориями:    
        'admin/category/create' => 'adminCategory/create',
        'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
        'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
        'admin/category' => 'adminCategory/index',
        'admin/categories/create' => 'adminCategories/create',
        'admin/categories/update/([0-9]+)/([0-9]+)' => 'adminCategories/update/$1/$2',
        'admin/categories/delete/([0-9]+)' => 'adminCategories/delete/$1',
        'admin/categories/([0-9]+)' => 'adminCategories/category/$1',
        'admin/categories' => 'adminCategories/index',
        // Управление заказами:
        'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
        'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
        'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
        'admin/order' => 'adminOrder/index',
        // Админпанель:
        'admin' => 'admin/index',
        'product/([view]+)/([0-9]+)' => 'product/view/$1/$2',
        'search/ajaxProduct/([a-zA-Z0-9]+)' => 'search/ajaxProduct/$1',
        'search/page=([0-9]+)' => 'search/index/$1',
        
        //'rating/add/([0-9]+)/([0-9]+)' => 'rating/add/$1/$2',
        //___________________________________________________________

        'rating/addRating/([0-9]+)/([0-9]+)' => 'rating/addRating/$1/$2',
        'rating/product/([0-9]+)' => 'rating/product/$1',

        //_____________________________________________________________
        //'rating/addAjax/([0-9]+)' => 'rating/addAjax/$1',
        //сравнение характеристик товаров
        'compare/add/([0-9]+)' => 'compare/add/$1',
        'compare/addAjax/([0-9]+)' => 'compare/addAjax/$1',
        'compare/delete/([0-9]+)' => 'compare/delete/$1',
        //сравнение характеристик товаров
        'catalog/([product]+)/page=([0-9]+)' => 'catalog/index/$1/$2',
        'catalog' => 'catalog/index',
        'filter/product' => 'filter/product',

        'goods/search/([a-zA-Z0-9]+)' => 'goods/search/$1/$2',
        'goods/items' => 'goods/index',

        //  ////

        'register/check/([a-zA-Z0-9]+)' => 'register/check/$1',
        'register/log/([a-zA-Z0-9]+)' => 'register/log/$1',
        'register' => 'register/register',
        'login' => 'register/login',
        'guest' => 'register/guest',
        'category/([filter]+)/([a-zA-Z0-9]+)' => 'catalog/category/$1/$2',
        'ajaxCategory/([0-9]+)' => 'category/ajaxCategory/$1',
        //'category/([0-9]+)/([0-9]+)' => 'catalog/category/$1/$1',
        'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController
        'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController
        'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax в CartController
        'cart/checkout' => 'cart/checkout',
        //_________________________________________________
        'user/register' => 'user/register',
        'user/login' => 'user/login',
        'user/logout' => 'user/logout',
        'cabinet/edit' => 'cabinet/edit',
        'cabinet' => 'cabinet/index',
        'contacts' => 'site/contact',
        //__________________________________________________
        'order/([package]+)' => 'order/index/$1',
        //'cart/([list]+)' => 'cart/index/$1',

        'package/data' => 'package/data',
        'package/product/([a-zA-Z0-9]+)' => 'package/product/$1',

        //__________________________________________________



        'order' => 'order/index/$1',
        //_________________________________
        'feature/product' => 'feature/product/$1',

        //_________________________________
        'items/product' => 'items/product',

        'items/compare/([0-9]+)' => 'items/compare/$1',
        'items/delete/([0-9]+)' => 'items/delete/$1',

        //_________________________________
        'list/buy' => 'list/buy',
        'list/clear' => 'list/clear',

        'list/category' => 'list/category',
        'list/countItems' => 'list/countItems',
        'list/cart' => 'list/cart',
        'list/product' => 'list/product',
        'list/totalprice' => 'list/totalprice',
        'list/productcount' => 'list/productcount',
        'list/delete/([0-9]+)' => 'list/delete/$1',
        'list/data' => 'list/data',
        'main/search/([a-zA-Z0-9]+)' => 'main/search/$1',
        'main/recomend' => 'main/recomend',
        'main/maxdiscount' => 'main/maxdiscount',
        'main/category' => 'main/category',
        //________________________________________


        'main' => 'main/index',
        'search/([goods]+)' => 'search/index/$1',
        'search' => 'search/index',
        'compare' => 'compare/index',
        'cart/([list]+)' => 'cart/index/$1',
        '([home]+)' => 'site/index/$1',
        'index.php' => 'site/index/$1',
        '' => 'site/index/$1',
    );
?>