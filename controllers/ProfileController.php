<?php 

class ProfileController
{
    use AppController;
    public function actionIndex()
    {
        $userId = User::checkLogged();

            
        echo json_encode($this->getNewObject('user')->getUserById($userId));

       return true;
    }
}