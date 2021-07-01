<?php 
    class CategoryController{
        use AppController;
        public $lists = ['cart', 'compare','wishlist'];
        public $counts = [];
        public $sessionName;
        public $className = 'cart';
        public function actionList(){
            $categoryList = array();
            $categoryList = $this->getNewObject('category')->getCategories();
            echo json_encode($categoryList);
            return true;
        }
        public function actionCounts()
        {
            foreach ($this->lists as $value) {
                $this->counts[] = $this->getCount($value);
            }
            echo json_encode($this->counts);
            return true;
        }
    }


?>