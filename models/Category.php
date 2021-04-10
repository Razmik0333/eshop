<?php

class Category extends Main
{
    public $tableName = 'category';
    public $categoryList = [];
    public function getCategories()
    {
       $categoryList = $this->findFields($this->tableName,['id','alias','arm_name']);
        return $categoryList;
    }
















    public static function getCategoriesById($category = false, $category_id = false)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM `item_category` WHERE `category` = :category AND `category_id` = :category_id';
        $result = $db->prepare($sql);
        $result->bindParam(':category', $category,PDO::PARAM_INT);
        $result->bindParam(':category_id', $category_id,PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    public static function getCategoryAllList($categoryId)
    {
        $db = Db::getConnection();
        $categoryList = array();

        $sql = 'SELECT id, category, category_id, category_arm_name FROM item_category WHERE category = :category';
        $result = $db->prepare($sql);
        $result->bindParam(':category',$categoryId,PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['category'] = $row['category'];
            $categoryList[$i]['category_id'] = $row['category_id'];
            $categoryList[$i]['category_arm_name'] = $row['category_arm_name'];
            $i++;
        }
        return $categoryList;
    }
  

    public static function createCategory($options)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO category (`name`,arm_name ) VALUES (:name, :arm_name)';
        $result = $db->prepare($sql);        
        $result->bindParam(':alias', $options['category_id']);
        $result->bindParam(':arm_name', $options['category']);
        return $result->execute();       
    }
    public static function createCategoriesItem($options)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO item_category (category,category_id, category_arm_name ) VALUES (:category, :category_id,:category_arm_name)';
        $result = $db->prepare($sql);        
        $result->bindParam(':category', $options['category_id']);
        $result->bindParam(':category_id', $options['category']);
        $result->bindParam(':category_arm_name', $options['name']);
        return $result->execute();       
    }
    public static function updateCategoriesItem($id,$options)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE item_category SET category = :category,category_id = :category_id, category_arm_name = :category_arm_name WHERE id = :id';
        $result = $db->prepare($sql);        
        $result->bindParam(':category', $options['category']);
        $result->bindParam(':category_id', $options['category_id']);
        $result->bindParam(':category_arm_name', $options['name']);
        $result->bindParam(':id', $id);

        return $result->execute();       
    }
    public static function updateCategory($id, $options)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE  category  SET `name` = :category, arm_name = :category_id WHERE id = :id';
        $result = $db->prepare($sql);        
        $result->bindParam(':category', $options['category']);
        $result->bindParam(':category_id', $options['category_id']);
        $result->bindParam(':id', $id);
        return $result->execute();        
    }
    public static function deleteCategoryById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM  category   WHERE id = :id';
        $result = $db->prepare($sql);        
        $result->bindParam(':id', $id);
        return $result->execute();        
    }   
    public static function deleteCategoriesById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM  item_category   WHERE id = :id';
        $result = $db->prepare($sql);        
        $result->bindParam(':id', $id);
        return $result->execute();        
    }   
    
   
}

?>