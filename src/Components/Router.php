<?php

namespace Bundles\Components;

use Bundles\Models\Initialization;
use Bundles\Controllers\FBKitController;


class Router extends Initialization
{
    public function __construct()
    {
        parent::__construct();
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return '';
    }

    /**
     * Call action according routes and url
     */
    public function run()
    {
        $uri = $this->getURI();
        try {
            foreach ($this->routes as $pattern => $path) {
                if (preg_match("~$pattern~", $uri)) {
                    $internalRoute = preg_replace("~$pattern~", $path, $uri);
                    $pathArr = explode('/', $internalRoute);
                    $controllerName = array_shift($pathArr) . 'Controller';
                    $controllerName = ucfirst($controllerName);
                    $actionName = 'action' . ucfirst(array_shift($pathArr));
                    $parameters = $pathArr;
                    switch ($controllerName) {
                        case'FBKitController':
                            $controllerObject = new FBKitController();
                            break;
                    }
                    $result = call_user_func_array([$controllerObject, $actionName], $parameters);
                    if ($result != null) {
                        break;
                    }
                }
            }
        } catch (\Exception $e) {
            error_log($e);
        }
    }

}