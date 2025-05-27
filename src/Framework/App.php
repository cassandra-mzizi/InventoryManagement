<?php

namespace Framework;

class App
{

    private Router $router; #no one cant edit

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run()
    {
        #calling the route when the server is started?
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        $this->router->dispatch($path, $method);
    }

    public function get(string $path, array $controller)
    {
        #we create a method so we can
        $this->router->add('GET', $path, $controller);
    }

}

