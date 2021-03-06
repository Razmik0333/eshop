<?php

class Product extends Main
{
    public $tableName = 'products';
    public $productsLists = [];
    const SHOW_BY_DEFAULT = 8;
    const RATING_VALUE = 4;

    public function productList()
    {
        $dbMembers = ['id', 'title', 'main',
        'image_basic','rating','cost','discount',
        'new_cost','desc','1c_articul'];
        //$this->productsLists = $this->findFields($this->tableName,$dbMembers,self::SHOW_BY_DEFAULT);
        $this->productsLists = $this->findFieldsByStr($this->tableName,'main',$dbMembers,'win',8);
        var_dump($this->productsLists);
        return $this->productsLists;
    }

     public static function getProductList(){

         $obj = new Product();
         return $obj->productList();
     }
    public static function getProductById($productId)
    {
        if ($productId) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM products WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $productId,PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            return $result->fetch();
        }
        
    }
    public static function getProductByStr($str,$page = false)
    {
        $db = Db::getConnection();
        $count = Product::SHOW_BY_DEFAULT;
        $offset = ($page - 1)*$count;
        $sql = 'SELECT * FROM products WHERE main LIKE "%":str"%" LIMIT :count OFFSET :offset';
        $result = $db->prepare($sql);
        $result->bindParam(':str', $str,PDO::PARAM_STR);
        $result->bindParam(':count', $count,PDO::PARAM_INT);
        $result->bindParam(':offset', $offset,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchAll();
    }
    public static function getTotalProducts()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id) AS count FROM products ';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);


        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
    public static function getTotalProductsFromStr($str = false, $page = false)
    {
        // Соединение с БД
        $db = Db::getConnection();
        //echo $str;
        $count = Product::SHOW_BY_DEFAULT;
        $offset = ($page - 1)*$count;

        // Текст запроса к БД
        $sql = "SELECT count(id) AS count FROM products WHERE main LIKE '%$str%' ";
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        //$result->bindParam(':str', $str, PDO::PARAM_STR);


        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }
    public static function getTotalProductsInCategory($categoryId, $isFavorite,$isNew,$isCheap,$price_min,$price_max)
    {
        $db = Db::getConnection();    // Соединение с БД
        $sql = 'SELECT count(id) AS count FROM products WHERE category = :category'; // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':category', $categoryId, PDO::PARAM_INT);
        if($isFavorite === 1){
            $limit = Product::RATING_VALUE;
            $sql = 'SELECT count(id) AS count FROM products WHERE category = :category AND rating >= :rating ';// Текст запроса к БД
            $result = $db->prepare($sql);
            $result->bindParam(':category', $categoryId, PDO::PARAM_INT);
            $result->bindParam(':rating', $limit, PDO::PARAM_INT);
        }
        if($price_max > 0 && $price_min > 0){
            $sql = 'SELECT count(id) AS count FROM products WHERE category = :category AND cost >= :cost1 AND cost <= :cost2 ';// Текст запроса к БД
            $result = $db->prepare($sql);
            $result->bindParam(':category', $categoryId, PDO::PARAM_INT);
            $result->bindParam(':cost1', $price_min, PDO::PARAM_INT);
            $result->bindParam(':cost2', $price_max, PDO::PARAM_INT);
        }
        $result->execute();// Выполнение коменды
        $row = $result->fetch();        // Возвращаем значение count - количество
        return $row['count'];
    }
    public static function getProductsInCategory($alias)
    {
        $db = Db::getConnection();    // Соединение с БД
        $sql = "SELECT id, title, main, image_basic, rating, cost, discount,new_cost, `desc`,1c_articul  FROM products WHERE alias = :alias";
        $result = $db->prepare($sql);
        $result->bindParam(':alias', $alias, PDO::PARAM_STR);// Используется подготовленный запрос
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $products = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['main'] = $row['main'];
            $products[$i]['image_basic'] = $row['image_basic'];
            $products[$i]['rating'] = $row['rating'];
            $products[$i]['cost'] = $row['cost'];
            $products[$i]['discount'] = $row['discount'];
            $products[$i]['new_cost'] = $row['new_cost'];
            $products[$i]['desc'] = $row['desc'];
            $i++;
        }
        return $products;// Выполнение коменды
    }
    public static function getMaxMinCost($alias, $param)
    {
        $db = Db::getConnection();
        if ($param == 'max') {
            $sql = 'SELECT  MAX(cost) AS max FROM products WHERE alias = :alias ';
        }else{
            $sql = 'SELECT  MIN(cost) AS min FROM products WHERE alias = :alias ';

        }
        
        $result = $db->prepare($sql);
        $result->bindParam(':alias', $alias, PDO::PARAM_STR);// Используется подготовленный запрос
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
    public static function getFilterProductsInCategory($categoryId, $categoryFilterId,$isFavorite,$isNew,$isCheap,$price_min,$price_max)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $sql = 'SELECT count(id) AS count FROM products WHERE category = :category AND category_id = :category_id';        // Используется подготовленный запрос
        
        $result = $db->prepare($sql);  
        $result->bindParam(':category', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':category_id', $categoryFilterId, PDO::PARAM_INT);

        if ($isFavorite ==1) {
            $sql = 'SELECT count(id) AS count FROM products WHERE category = :category AND category_id = :category_id  AND rating >= :rating ';
            $result = $db->prepare($sql);
            $limit = Product::RATING_VALUE;
            $result->bindParam(':category', $categoryId, PDO::PARAM_INT);
            $result->bindParam(':category_id', $categoryFilterId, PDO::PARAM_INT);
            $result->bindParam(':rating', $limit, PDO::PARAM_INT);
        }
        if($price_max > 0 && $price_min > 0){
            $sql = 'SELECT count(id) AS count FROM products WHERE category = :category AND category_id = :category_id AND cost >= :cost1 AND cost <= :cost2 ';// Текст запроса к БД
            $result = $db->prepare($sql);
            $result->bindParam(':category', $categoryId, PDO::PARAM_INT);
            $result->bindParam(':category_id', $categoryFilterId, PDO::PARAM_INT);
            $result->bindParam(':cost1', $price_min, PDO::PARAM_INT);
            $result->bindParam(':cost2', $price_max, PDO::PARAM_INT);
        }
        $result->execute();
        $row = $result->fetch();        // Выполнение коменды

        return $row['count'];        // Возвращаем значение count - количество

    }

    public static function getProductsFilterListByCategory($categoryId, $categoryFilterId,  $page, $isFavorite,$isNew,$isCheap,$price_min,$price_max)
    {
        $db = Db::getConnection();
        $count = Product::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * $count;
        $products = array();

        if($categoryId && $categoryFilterId) {
        $sql_start = "SELECT * FROM products  WHERE category = $categoryId AND  category_id = $categoryFilterId ";
        $sql_end = "LIMIT $count OFFSET $offset ";
            if($isFavorite === 1) {
                $sql_start.= "AND rating >= 4 ";
                $sql_start.=$sql_end;
            }
            if($isFavorite === 1  && $isNew === 1 && $isCheap === false){
                $sql_start.="AND rating >= 4  ";
                $sql_start.="ORDER BY id DESC  ";
                $sql_start.=$sql_end;
            }
            if($isFavorite === 1  && $isNew === false && $isCheap === 1){
                $sql_start.="AND rating >= 4  ";
                $sql_start.="ORDER BY cost DESC  ";
                $sql_start.=$sql_end;
            }
            if($isNew == 1) {
                $sql_start.= "ORDER BY id DESC ";
                $sql_start.=$sql_end;
            }
            if($isCheap == 1) {
                $sql_start.= " ORDER BY cost DESC ";
                $sql_start.=$sql_end;
            }
            if($price_min > 0 && $price_max > 0) {
                $result = $db->query("AND `cost` >= '$price_min' AND cost <= '$price_max'" );
                $sql_start.=$sql_end;
            }
            if($isFavorite === false && $isNew === false && $isCheap === false) {
                if($price_min > 0 && $price_max > 0) {
                    $sql_start.="AND `cost` >= '$price_min' AND cost <= '$price_max'";
                    $sql_start.=$sql_end;
                }
                if($price_min ==false && $price_max == false) {
                    $sql_start.=$sql_end;
                }
            }
            $result = $db->query($sql_start);
        }
        if($categoryId && $categoryFilterId == false){
            $sql_start = "SELECT * FROM products  WHERE category = $categoryId ";
            $sql_end = "LIMIT $count OFFSET $offset";
            if($isFavorite === 1  && $isNew === false && $isCheap === false){
                $sql_start.="AND rating >= 4  ";
                $sql_start.=$sql_end;
            }
            if($isFavorite === 1  && $isNew === 1 && $isCheap === false){
                $sql_start.="AND rating >= 4  ";
                $sql_start.="ORDER BY id DESC  ";
                $sql_start.=$sql_end;
            }
            if($isFavorite === 1  && $isNew === false && $isCheap === 1){
                $sql_start.="AND rating >= 4  ";
                $sql_start.="ORDER BY cost DESC  ";
                $sql_start.=$sql_end;
            } 
            if($isFavorite === false  && $isNew === 1 && $isCheap === false ) {
                $sql_start.="ORDER BY id DESC  ";
                $sql_start.=$sql_end;
            }
            if($isFavorite === false  && $isNew === false && $isCheap === 1) {
                $sql_start.="ORDER BY cost DESC   ";
                $sql_start.=$sql_end;
            }
            if($isFavorite === false && $isNew === false && $isCheap === false) {
                if($price_min > 0 && $price_max > 0) {
                    $sql_start.="AND `cost` >= '$price_min' AND cost <= '$price_max'";
                    $sql_start.=$sql_end;
                }
                if($price_min ==false && $price_max == false) {
                    $sql_start.=$sql_end;
                }
            }
        }
        $result = $db->query($sql_start);
        //$result->setFetchMode(PDO::FETCH_ASSOC);
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['main'] = $row['main'];
            $products[$i]['image_basic'] = $row['image_basic'];
            $products[$i]['rating'] = $row['rating'];
            $products[$i]['cost'] = $row['cost'];
            $products[$i]['discount'] = $row['discount'];
            $products[$i]['new_cost'] = $row['new_cost'];
            $products[$i]['desc'] = $row['desc'];
            $i++;
        }
         return $products;
    }
    public static function getProductByIds($idsArray)
    {
        
        $db = Db::getConnection();
        if($idsArray){
            $idsString = implode(',', $idsArray);
            $sql = "SELECT * FROM products WHERE id IN ($idsString)";
            $result = $db->query($sql);
            $products = array();
            //$result->setFetchMode(PDO::FETCH_ASSOC);
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['title'] = $row['title'];
                $products[$i]['main'] = $row['main'];
                $products[$i]['image_basic'] = $row['image_basic'];
                $products[$i]['cost'] = $row['cost'];
                $products[$i]['rating'] = $row['rating'];
                $products[$i]['desc'] = $row['desc'];
                $products[$i]['availability'] = $row['availability'];
                $i++;
            }

            return $products;
        }
        return false;
    }
    public static function getProductByIdsString($idsString)
    {
        
        $db = Db::getConnection();
        if($idsString){
            $sql = "SELECT * FROM products WHERE id IN ($idsString)";
            $result = $db->query($sql);
            $products = array();
            //$result->setFetchMode(PDO::FETCH_ASSOC);
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['title'] = $row['title'];
                $products[$i]['main'] = $row['main'];
                $products[$i]['image_basic'] = $row['image_basic'];
                $products[$i]['cost'] = $row['cost'];
                $products[$i]['rating'] = $row['rating'];
                $products[$i]['desc'] = $row['desc'];
                $products[$i]['availability'] = $row['availability'];
                $i++;
            }

            return $products;
        }
        return false;
    }
    public static function saveToSession($str,$name){
        $_SESSION[$str] = $name;
    }
    
    public static function getFromSession($name){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
        return false;
    }
    public static function getDiscountMax(){
        $db = Db::getConnection();
        $sql = 'SELECT  MAX(discount) AS max FROM products ';
        $result = $db->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);

    }
    public static function getProductFromDiscount($discount = false )
    {
        if ($discount) {
            $db = Db::getConnection();
            $sql = "SELECT * FROM products WHERE discount = :discount";
            $result = $db->prepare($sql);
            $result->bindParam(':discount', $discount, PDO::PARAM_INT);
            $result->execute();
            $products = array();
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['title'] = $row['title'];
                $products[$i]['main'] = $row['main'];
                $products[$i]['image_basic'] = $row['image_basic'];
                $products[$i]['rating'] = $row['rating'];
                $products[$i]['cost'] = $row['cost'];
                $products[$i]['new_cost'] = $row['new_cost'];
                $products[$i]['desc'] = $row['desc'];
                $products[$i]['time_add'] = $row['time_add'];
                $i++;
            }
            return $products;
        }
    }
    public static function getRecomendProducts($count = false)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM products WHERE `is_recomended` = 1  ORDER BY id DESC LIMIT :count";
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $products = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['main'] = $row['main'];
            $products[$i]['image_basic'] = $row['image_basic'];
            $products[$i]['rating'] = $row['rating'];
            $products[$i]['cost'] = $row['cost'];
            $products[$i]['new_cost'] = $row['new_cost'];
            $products[$i]['desc'] = $row['desc'];
            $products[$i]['time_add'] = $row['time_add'];
            $i++;
        }
        return $products;
    }

    public static function deleteProductById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM products WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();        
    }
    public static function getRating($id) //$idItem id товара
    {
        $db = Db::getConnection();
        $sql = "SELECT rating FROM products WHERE id = :id";
        $result = $db->prepare($sql);  
        $result->bindParam(':id',$id,PDO::PARAM_INT);  
        $result->execute();      
        $rating = $result->fetch(PDO::FETCH_ASSOC);
        return $rating;
        
    }
    
    public static function getRatingString($id) //$idItem id товара
    {
        $db = Db::getConnection();
        $sql = 'SELECT rating_string FROM products WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();        
        $result = $result->fetch(PDO::FETCH_ASSOC);
        $ratings_string = $result['rating_string'];
        return $ratings_string;
        
    }
    public static function insertRating($id,$rating)//$id id товара $idRating значение оценки
    {
        $db = Db::getConnection();
        $sql = 'UPDATE  products  SET rating = :rating  WHERE id = :id';
        $result = $db->prepare($sql);        
        $result->bindParam(':rating', $rating);
        $result->bindParam(':id', $id);
        return $result->execute();
        
    }
    public static function insertRatingString($id,$string)//$idItem id товара $idRating значение оценки
    {
        $db = Db::getConnection();
        $sql = 'UPDATE  products  SET rating_string = :rating_string  WHERE id = :id';
        $result = $db->prepare($sql);        
        $result->bindParam(':rating_string', $string);
        $result->bindParam(':id', $id);
        return $result->execute();
        
    }

    
    public static function createProduct($options)
    {
        $db = Db::getConnection();
        $time =  time();
        $newCost = ($options['discount'] * $options['cost'])/100 ;
        $sql = 'INSERT INTO products (category,category_id, `desc`,  cost, discount,  is_recomended, `availability`, main, 1c_articul, time_add) VALUES (:category, :category_id, :item_name, :cost, :is_recommended, :availabile, :main, :code, :time_add)';
        $result = $db->prepare($sql);        
        $result->bindParam(':category', $options['category']);
        $result->bindParam(':category_id', $options['category_id']);
        $result->bindParam(':item_name', $options['item_name']);        
        $result->bindParam(':cost', $options['cost']);       
        $result->bindParam(':discount', $newCost);       
        $result->bindParam(':is_recommended', $options['is_recommended']);
        $result->bindParam(':availabile', $options['availabile']);
        $result->bindParam(':main', $options['main']);
        $result->bindParam(':code', $options['code']);
        $result->bindParam(':time_add', $time);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        return 0;        
    }
    public static function updateProduct($id, $options)
    {
        $db = Db::getConnection();

        $time =  time(); 
        $sql = 'UPDATE  products  SET category = :category, category_id = :category_id, `desc` = :item_name,  discount =:discount, new_cost =:new_cost, is_recomended = :is_recommended, `availability` = :availabile, main = :main, 1c_articul = :code,time_add = :time_add WHERE id = :id';
        $result = $db->prepare($sql);        
        $result->bindParam(':category', $options['category']);
        $result->bindParam(':category_id', $options['category_id']);
        $result->bindParam(':item_name', $options['item_name']);        
        $result->bindParam(':discount', $options['discount']);       
        $result->bindParam(':new_cost', $options['new_cost']);       
        $result->bindParam(':is_recommended', $options['is_recommended']);
        $result->bindParam(':availabile', $options['availabile']);
        $result->bindParam(':main', $options['main']);
        $result->bindParam(':code', $options['code']);
        $result->bindParam(':time_add', $time);
        $result->bindParam(':id', $id);
        return   $result->execute();     
    }
    public static function getImage($filename)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
        // Путь к папке с товарами
        $path = '/template/images/';
        // Путь к изображению товара
        $pathToProductImage1 = $path . $filename.'.png';
        $pathToProductImage2 = $path . $filename.'.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage1)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage1;
        }elseif(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage2)) {
            return $pathToProductImage2;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }
   
}

?>



