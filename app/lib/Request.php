<?php


namespace app\lib;


class Request
{
    protected string $url;
    protected string $method;
    protected ?array $params;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->url = parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH) ?: '/';
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = $this->url !== '/' ? array_slice(explode('/', $this->url), 0) : null;
    }

    /**
     * @return mixed|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed|string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }


}