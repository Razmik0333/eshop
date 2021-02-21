<?php 
    class CartController
    {

        public  function actionAdd($id)
        {
            
            Cart::addProduct($id);
            $refferer = $_SERVER['HTTP_REFERER'];
            header("Location: $refferer ");
            return true;

        }
        public function actionDelete($id)
        {
            Cart::deleteProduct($id);
            header("Location: /cart/list ");
            return true;

        }
        public function actionAddAjax($id)
        {
            echo Cart::addProduct($id);
            return true;

        }


        public function actionIndex($filename)
        {
            $arrStyle = ['bootstrap.min','fonts',$filename];
            $fileStyle = Page::getStyles($arrStyle);
            $arrScripts = ['bootstrap.min','email','functions','category',$filename];
            $fileScript = Page::getScripts($arrScripts);
            // $categoryList = array();
            // $categoryList = Category::getCategoryList();
            // $productsInCart = false;
            // $productsInCart = Cart::getProducts();
            // if($productsInCart){
            //     $productsIds = array_keys($productsInCart);
            //     $products = Product::getProductByIds($productsIds);
            //     $totalPrice = Cart::getTotalPrice($products);
            //     $countItem = Cart::countItem($products);
            // } else {
            //     header("Location: / ");
            // }           
            require_once(ROOT.'/views/cart/'.$filename.'.php');//подключение файлов системы
            return true;
        }

        public function actionCheckout()
        {
            $categoryList = array();
            $categoryList = Category::getCategoryList();
            $productsInCart = false;
            $productsInCart = Cart::getProducts();
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductByIds($productsIds);
            //var_dump($productsInCart);
            $totalPrice = Cart::getTotalPrice($products);
            $userName = false;
            $userPhone = false;
            $userComment = false;
            $result = false;// Статус успешного оформления заказа

            if (!User::isGuest()) {
                $userId = User::checkLogged();// Если пользователь не гость
                $user = User::getUserById($userId);// Получаем информацию о пользователе из БД
                $userName = $user['name'];
            } else {
                $userId = false;// Если гость, поля формы останутся пустыми
            }
            if (isset($_POST['send'])) {// Если форма отправлена
                $userName = $_POST['userName'];
                $userPhone = $_POST['userPhone'];// Получаем данные из формы
                $userComment = $_POST['userComment'];
                // Флаг ошибок
                $errors = false;
                // Валидация полей
                if (!User::checkName($userName)) {
                    $errors[] = 'Неправильное имя';
                }
                if (!User::checkPhone($userPhone)) {
                    $errors[] = 'Неправильный телефон';
                }  
                if ($errors == false) {
                    // Если ошибок нет
                    // Сохраняем заказ в базе данных
                    $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);
                    if ($result) {
                        // Если заказ успешно сохранен
                        // Оповещаем администратора о новом заказе по почте                
                        $adminEmail = 'razmik0333@gmail.ru';
                        $message = '<a href="http://eshopoop.com/orders">Список заказов</a>';
                        $subject = 'Новый заказ!';
                        mail($adminEmail, $subject, $message);
                        // Очищаем корзину
                        Cart::clear();
                    }
                }
            } 
            require_once(ROOT . '/views/cart/checkout.php');//подключение файлов системы
            return true;
        }
    }


?>