<?php

class Product extends Main
{
    public $tableName = 'products';
    public $productsLists = [];
    public $requiredFields =  ['id','main','descr','cost','discount','availability','rating','alias','category','arm_name','1c_articul'];
    const SHOW_BY_DEFAULT = 8;
    const RATING_VALUE = 4;

    public function getProductList()
    {

        $this->productsLists = $this->findFields($this->tableName,$this->requiredFields,8);
        return $this->productsLists;
    }
    public function getRecomendProducts()
    {

        $this->productsLists = $this->findFieldById($this->tableName, ['is_recomended' => 1],$this->requiredFields,3);
        return $this->productsLists;
    }

    public function getProductById($productId)
    {
        if ($productId) {
            $this->productsLists = $this->findFieldById($this->tableName, ['id' => $productId],$this->requiredFields,1)[0];
            return $this->productsLists;
        }
        return false;
    }
    public function getProductByStr($str)
    {

        $this->productsLists = $this->findFieldsByStr($this->tableName,'main',$this->requiredFields,$str,8);
        return $this->productsLists;
    }
    public function deleteProductById($id)
    {
        $this->deleteFieldById($this->tableName, ['id' => $id]);
        return true;
    }
    public function getProductByIds($idsArray)
    {
        if($idsArray){ //[20, 21, 22]

            $this->productLists = $this->findFieldsByIds($this->tableName,'id',$idsArray,$this->requiredFields);
            return $this->productLists;
        }
        return false;
    }
    public function getProductFromDiscount($discount = false )
    {
        if ($discount) {
            $this->productsLists = $this->findFieldById($this->tableName, ['discount' => $discount],$this->requiredFields,1);
            return $this->productsLists;
        }
    }
    public function getDiscountMax()
    {
        return $this->getMaxItem('discount',null, 'max');
    }
    public function getProductsInCategory($alias){
        if ($alias) {
            $this->productsLists = $this->findFieldById($this->tableName, ['alias' => $alias],$this->requiredFields,null);
            return $this->productsLists;
            
        }
    }

    public function getTotalProducts($alias,$param){
        return $this->getMaxItem('cost',['alias' => $alias],$param);
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
    public function createProduct($arrayOfField)
    {
        $time =  time();

        return  $this->insertField($this->tableName, [
            'alias' => $arrayOfField['alias'],
            'descr' => $arrayOfField['descr'],
            'cost' => $arrayOfField['cost'],
            'discount' => $arrayOfField['discount'],
            'is_recomended' => $arrayOfField['is_recommended'],
            'availability' => $arrayOfField['availabile'],
            'main' => $arrayOfField['main'],
            '1c_articul' => $arrayOfField['1c_articul'],
            'time_add' => $time            
        ]
        ); 
        
    }
    
    public function updateProduct($id, $arrayOfField)
    {

        $time =  time(); 
        $this->updateFieldById($this->tableName,[
            'alias' => $arrayOfField['alias'],
            'descr' => $arrayOfField['descr'],
            'cost' => $arrayOfField['cost'],
            'discount' => $arrayOfField['discount'],
            'is_recomended' => $arrayOfField['is_recommended'],
            'availability' => $arrayOfField['availabile'],
            'main' => $arrayOfField['main'],
            '1c_articul' => $arrayOfField['1c_articul'],
            'time_add' => $time            
        ], ['id' => $id]);
        return true;
    }
    public static function getImage($filename)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
        // Путь к папке с товарами
        $path = '/template/images/';
        // Путь к изображению товара

        $pathToProductImage = $path . $filename.".jpg";
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара

            return $pathToProductImage;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }
   
}

?>



