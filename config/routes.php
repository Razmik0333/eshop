<?php

return array(
        'admin/product/create' => 'adminProduct/create',
        'admin/product/item/([0-9]+)' => 'adminProduct/item/$1',
        'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
        'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
        'admin/product' => 'adminProduct/index',
        // Управление категориями:    
        'admin/category/create' => 'adminCategory/create',
        'admin/category/item/([0-9]+)' => 'adminCategory/item/$1',

        'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
        'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
        'admin/category' => 'adminCategory/index',
        'admin/categories/create' => 'adminCategories/create',
        'admin/categories/update/([0-9]+)/([0-9]+)' => 'adminCategories/update/$1/$2',
        'admin/categories/delete/([0-9]+)' => 'adminCategories/delete/$1',
        'admin/categories/([0-9]+)' => 'adminCategories/category/$1',
        'admin/categories' => 'adminCategories/index',
        // Управление заказами:
        'admin/order/create' => 'adminOrder/create',
        'admin/order/item' => 'adminOrder/item',
        'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
        'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
        'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
        'admin/order' => 'adminOrder/index',
        // Админпанель:
        'admin' => 'admin/index',
        'product/([view]+)/([0-9]+)' => 'product/view/$1/$2',
        'commodity/recomend' => 'commodity/recomend/$1',
        'commodity/productCount' => 'commodity/productCount',

        'commodity/product' => 'commodity/product',
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
        'catalog/([product]+)' => 'catalog/index/$1',
        //'catalog' => 'catalog/index',
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
        'cart/add/([0-9]+)/([0-9]+)' => 'cart/add/$1/$2', // actionAdd в CartController
        'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController
        'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax в CartController
        'cart/checkout' => 'cart/checkout',
        //_____________________________________________
        'wishlist/items' => 'wishlistItem/wishlist', // actionAdd в WishlistController


        'wishlist/add/([0-9]+)' => 'wishlistItem/add/$1', // actionAdd в WishlistController
        'wishlist/delete/([0-9]+)' => 'wishlistItem/delete/$1', // actionDelete в WishlistController
        'wishlist/productCount' => 'wishlistItem/productcount',
        'wishlist/([page]+)' => 'wishlist/index/$1',

        //_________________________________________________
        'user/register' => 'user/register',
        'user/login' => 'user/login',
        'user/logout' => 'user/logout',
        'cabinet/edit' => 'cabinet/edit',
        'cabinet/([page]+)' => 'cabinet/index/$1',
        'cabinet' => 'cabinet/index/$1',
        'contacts' => 'site/contact',
        //__________________________________________________
        'order/([package]+)' => 'order/index/$1',
        //'cart/([list]+)' => 'cart/index/$1',

        'package/data' => 'package/data',
        'package/product/([a-zA-Z0-9]+)' => 'package/product/$1',

        //__________________________________________________

        'profile' => 'profile/index',

        'order' => 'order/index/$1',
        //_________________________________

        //_________________________________
        'items/product' => 'items/product',

        'items/compare/([0-9]+)' => 'items/compare/$1',
        'items/delete/([0-9]+)' => 'items/delete/$1',
        'items/productCount' => 'items/productcount',
        //_________________________________
        'list/buy' => 'list/buy',
        'list/clear' => 'list/clear',

        'category/list' => 'category/list',
        'category/counts' => 'category/counts',
        // 'list/countItems' => 'list/countItems',



        'list/cart/([0-9]+)/([0-9]+)' => 'list/cart/$1/$2',




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