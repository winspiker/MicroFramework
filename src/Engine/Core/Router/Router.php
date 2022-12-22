<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Core\Router;


use Winspiker\MicroFramework\Engine\Core\Router\DispatchedRoute;
use Winspiker\MicroFramework\Engine\Core\Router\UrlDispatcher;

final class Router
{
    private array $routes = [];

    private UrlDispatcher $dispatcher;

    public string $host;

    public function __construct(string $host = 'http://localhost/')
    {
        $this->host = $host;
    }

    public function add(string $key, string $pattern, array $controller, string $method = 'GET'): void
    {
        $this->routes[$key] = compact('pattern', 'controller', 'method');
    }

    public function dispatch(string $method, string $uri): ?DispatchedRoute
    {
        return $this
            ->getDispatcher()
            ->dispatch($method, $uri);
    }

    public function getDispatcher(): UrlDispatcher
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