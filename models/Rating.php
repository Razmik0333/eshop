<?php 

class Rating extends Product {
    public $rating;
    public $ratingString;

    //get
    public function getRating($id)
    {
        $this->rating = $this->getFieldValue($this->tableName,['id' => $id],'rating');
        return $this->rating;
        
    }
    public function getRatingString($id)
    {
        $this->ratingString = $this->getFieldValue($this->tableName,['id' => $id],'rating_string');
        return $this->ratingString;
    }
    //get
    //insert
    public function updateRating($id,$rating,$rating_string)
    {
        $this->updateFieldById($this->tableName,['rating'=>$rating,'rating_string' => $rating_string],['id' => $id]);
        return true;
        
    }


    //insert

    public function returnNewString($string, $rating)
    {
        return  $string. '|' . $rating;
    }
    public function getNewRating($currentString)
    {
        $currentArray = explode('|', $currentString);
        $count = count($currentArray);
        $summ = array_sum($currentArray);
        $newRating = number_format($summ / $count, 2);
        return $newRating;
    }

}