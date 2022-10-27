<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Core\Router;


use Winspiker\MicroFramework\Engine\Core\Router\DispatchedRoute;
use Winspiker\MicroFramework\Engine\Core\Router\UrlDispatcher;

class Router
{
    /**
     * @var array
     */
    private array $routes = [];
    /**
     * @var mixed
     */
    private $dispatcher;
    /**
     * @var string|mixed
     */
    public string $host;

    /**
     * @param string $host
     */
    public function __construct(string $host = 'http://localhost/')
    {
        $this->host = $host;
    }

    /**
     * @param $key
     * @param $pattern
     * @param $controller
     * @param string $method
     * @return void
     */
    public function add($key, $pattern, $controller, string $method = 'GET'): void
    {
        $this->routes[$key] = compact('pattern', 'controller', 'method');
    }

    /**
     * @param $method
     * @param $uri
     * @return DispatchedRoute|void
     */
    public function dispatch($method, $uri)
    {
        return $this->getDispatcher()->dispatch($method, $uri);
    }

    /**
     * @return mixed
     */
    public function getDispatcher()
    {
        if ($this->dispatcher === null) {
            $this->dispatcher = new UrlDispatcher();
            foreach ($this->routes as $route) {
                $this->dispatcher->register($route['method'], $route['pattern'], $route['controller']);
            }
        }
        return $this->dispatcher;
    }
}