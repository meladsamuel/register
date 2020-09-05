<?php


namespace app\lib;


class Router
{
    public array $routes;
    protected string $url;
    protected string $method;
    protected ?array $params;
    protected static $middleware;
    protected SessionManager $session;
    private Messenger $messenger;

    /**
     * Router constructor.
     * @param Request $request
     * @param SessionManager $session
     * @param Messenger $messenger
     */
    public function __construct(Request $request, SessionManager $session, Messenger $messenger)
    {
        $this->url = $request->getUrl();
        $this->method = $request->getMethod();
        $this->params = $request->getParams();
        $this->session = $session;
        $this->messenger = $messenger;
    }

    protected function add(string $methods, string $url, $callback)
    {
        $url = trim($url, '/') ?: '/';
        foreach (explode('|', $methods) as $method) {
            $this->routes[] = [
                'url' => $url,
                'method' => strtoupper($method),
                'callback' => $callback,
                'middleware' => static::$middleware
            ];
        }
    }

    public function get(string $path, $handler)
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, $handler)
    {
        $this->add('POST', $path, $handler);
    }

    public function any(string $path, $handler)
    {
        $this->add('GET|POST', $path, $handler);
    }

    public function dispatch(): bool
    {
        foreach ($this->routes as $route) {
            if ($this->url === $route['url']) {
                if (is_callable($route['callback'])) {
                    $route['callback']();
                    return true;
                } elseif (strpos($route['callback'], '@')) {
                    list($controller, $method) = explode('@', $route['callback']);
                    $controller = 'app\\controllers\\' . $controller;
                    if (class_exists($controller)) {
                        $object = new $controller($this->session, $this->messenger , $method);
                        if (method_exists($object, $method) !== false) {
                            $object->$method();
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
        return false;
    }
}