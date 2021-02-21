<?php
    class RatingController
        {      
            public function actionAdd($id = false, $idRating = false)
            {
                $categoryList = array();
                $categoryList = Category::getCategoryList();
                $currentRating = Product::getRating($id);
                if($currentRating == 0){
                    Product::insertRating($id, $idRating);
                    Product::insertRatingString($id, $idRating);
                }else{
                    $currentString = Product::getRatingString($id);
                    $newString = $currentString . '|' .$idRating;
                    Product::insertRatingString($id, $newString);    
                    $currentString = Product::getRatingString($id);
                    $currentArray = explode('|', $currentString);
                    $count = count($currentArray);
                    $summ = array_sum($currentArray);
                    $newRating = number_format($summ / $count, 2);
                    Product::insertRating($id, $newRating);
                }                 
                return true;
                
            }

            public function actionAddRating($productId, $ratingId)
            {
                $currentRating = Product::getRating($productId);

                if($currentRating == 0){
                    Product::insertRating($productId, $ratingId);
                    Product::insertRatingString($productId, $ratingId);
                    echo json_encode($ratingId);
                }else{
                    $currentString = Product::getRatingString($productId);
                    $newString = $currentString . '|' .$ratingId;
                    Product::insertRatingString($productId, $newString);    
                    $currentString = Product::getRatingString($productId);
                    $currentArray = explode('|', $currentString);
                    $count = count($currentArray);
                    $summ = array_sum($currentArray);
                    $newRating = number_format($summ / $count, 2);
                    Product::insertRating($productId, $newRating);
                    echo json_encode($newRating);
                }   
                
                return true;
            }
            public function actionAddAjax($id){
                echo Product::getRating($id);
                return true;
            }
            public function actionProduct($id)
            {
                //echo json_encode($id);
                $changeArrayRating = Product::getProductById($id);
                echo json_encode($changeArrayRating);
                return true;
            }

            
            
        }  
?>