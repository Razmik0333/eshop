<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    //return request string
    protected function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }
    public function run()
    {
        //получить строку запроса
        $uri = $this->getURI();
        $uriDef = $uri;
        if(strpos($uri,"?") !== false){
            $uriArr = explode('?', $uri);
            $uriDef = $uriArr[0];
            
        }


        foreach ($this->routes as $uriPattern => $path) {
            if(preg_match("~$uriPattern~",$uri))
            {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uriDef);

                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));
                $parameters = $segments;
                $controllerFile = ROOT . '/controllers/'.$controllerName.'.php';
                if(file_exists($controllerFile)){
                    include_once($controllerFile);
                }
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName),$parameters);
                if($result != null){
                    break;
                }
            }
        }
    }
}
?>