<?php

namespace Bundles\Models;

class Initialization
{
    protected $config;
    protected $routes;

    public function __construct()
    {
        $paramsPath = ROOT . '/app/config/config.php';
        $this->config = include $paramsPath;

        $routePath = ROOT . '/app/config/routes.php';
        $this->routes = include($routePath);
    }
}
