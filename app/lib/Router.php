<?php


namespace app\lib;


class Router
{
    public array $routes = ['GET' => [], 'POST' => []];
    protected string $url;
    protected string $method;
    protected array $params;

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->url = $request->getUrl();
        $this->method = $request->getMethod();
        $this->params = $request->getParams();
    }
    public function use(string $routeFile): Router {
        if (file_exists(ROUTER_PATH . $routeFile. '.php')) {
            $route = $this;
            require ROUTER_PATH . $routeFile . '.php';
            return $route;
        }
        return null;
    }
    public function get(string $path, $handler) {
        echo $path;
        echo '<br>';
        echo $this->params[0];
        echo '<br>';
        $this->routes['GET'][$path] = $handler;
    }
    public function dispatch() {
        if(is_callable($this->routes[$this->method])) {
            $callback = $this->routes;
            return $callback();
        }
        return null;
    }


}