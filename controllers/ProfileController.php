<?php 

class ProfileController extends AppController{
    public function actionIndex()
    {
        $userId = User::checkLogged();

            
        echo json_encode($this->getNewObject('user')->getUserById($userId)[0]);
           /*$user = $this->getNewObject('user')->getUserById($userId);
       //var_dump($user);
       $order = $this->getNewObject('order')->getOrdersById($userId);
       echo json_encode($order);*/
       return true;
    }
}