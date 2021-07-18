<?php
    class RatingController extends Product
        {      
            use AppController;

            public $rating;
            public function __construct()
            {
               $this->rating = $this->getNewObject('rating');
            }
            public function actionAddRating($productId, $ratingId)
            {
                $currentRating = $this->rating->getRating($productId);
                if ($currentRating == 0) {
                    $this->rating->updateRating($productId,$ratingId,$ratingId);
                    echo json_encode($ratingId);
                }else{
                    $currentString = $this->rating->getRatingString($productId);
                    $newString = $this->rating->returnNewString($currentString, $ratingId);
                    $newRating = $this->rating->getNewRating($newString);
                    $this->rating->updateRating($productId,$newRating,$newString);
                    echo json_encode($newRating);
                }                
                return true;
            }
            public function actionAddAjax($id){
                //echo Product::getRating($id);
                return true;
            }
            public function actionProduct($id)
            {
                //echo json_encode($id);
                //$changeArrayRating = Product::getProductById($id);
                //echo json_encode($changeArrayRating);
                return true;
            }

            
            
        }  
?>