<?php

class Category extends Main
{
    public $tableName = 'category';
    public $categoryList = [];
    public $requiredFields =  ['id','alias','arm_name'];

    public function getCategories()
    {
       $categoryList = $this->findFields($this->tableName,['id','alias','arm_name'],3);
        return $categoryList;
    }
    public function getCategoryById($categoryId)
    {
        if ($categoryId) {
            $this->categoryList = $this->findFieldById($this->tableName, ['id' => $categoryId],$this->requiredFields,1)[0];
            return $this->categoryList;
        }
        return false;
    }
    public function createCategory($arrayOfField)
    {
        $time =  time();
        //var_dump($arrayOfField);
        return  $this->insertField($this->tableName, [
            'alias' => $arrayOfField['alias'],
            'arm_name' => $arrayOfField['arm_name'],            
        ]
        ); 
        
    }
    
    public function updateCategory($id, $arrayOfField)
    {

        $time =  time(); 
        $this->updateFieldById($this->tableName,[
            'alias' => $arrayOfField['alias'],
            'arm_name' => $arrayOfField['arm_name'],            
        ], ['id' => $id]);
        return true;
    }

    public function deleteCategoryById($id)
    {
        $this->deleteFieldById($this->tableName, ['id' => $id]);
        return true;
    }
    
   
}

?>