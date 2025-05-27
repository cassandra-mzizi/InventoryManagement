<?php
#Job of the router is to display the page for a specific URL
declare(strict_types=1);

namespace Framework;

class Router
{

    private array $routes = [];

    #Adding routes
    public function add(string $method, string $path, array $controller)
    {
        #Creating a standard uniform path
        $path = $this->normalizePath($path);

        $this->routes[] = [ #multidimantional array
          'path' => $path,
          'method' => strtoupper($method),
          'controller' => $controller
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";
        return preg_replace('#[/]{2,}#', '/', $path);
    }

    #To dispatch to our content
    public function dispatch(string $path, string $method)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        #looping through our routes. Why? --- so we can get a match to dispatch
        foreach ($this->routes as $route) {
            if (!preg_match(
                "#^{$route['path']}$#",
                $path,
              ) || $route['method'] !== $method
            ) {
                continue;
            }
            #grabing the class and method name from route. Controller (array)
            # stores the class and method name. [ ] = Destructuring
            [$class, $function] = $route['controller'];

            #Starting an instance
            $controllerInstance = new $class();
            $controllerInstance->{$function}();


        }
    }




}