<?php
    class RatingController extends 
        {      
            use AppController;

            public function actionAddRating($productId, $ratingId)
            {
                $currentRating = $this->getNewObject('rating')->getRating($productId);
                if ($currentRating == 0) {
                    $this->getNewObject('rating')->updateRating($productId,$ratingId,$ratingId);
                    echo json_encode($ratingId);
                }else{
                    $currentString = $this->getNewObject('rating')->getRatingString($productId);
                    $newString = $this->getNewObject('rating')->returnNewString($currentString, $ratingId);
                    $newRating = $this->getNewObject('rating')->getNewRating($newString);
                    $this->getNewObject('rating')->updateRating($productId,$newRating,$newString);
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