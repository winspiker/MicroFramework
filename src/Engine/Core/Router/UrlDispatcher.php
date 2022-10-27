<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Core\Router;

use Winspiker\MicroFramework\Engine\Core\Router\DispatchedRoute;

class UrlDispatcher
{
    private array $method = [
        'GET',
        'POST'
    ];

    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * @var array|string[]
     */
    private array $patterns = [
        'int' => '[0-9]+',
        'str' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+'
    ];

    /**
     * @param $key
     * @param $pattern
     * @return void
     */
    public function addPattern($key, $pattern): void
    {
        $this->patterns[$key] = $pattern;
    }

    /**
     * @param $method
     * @return array
     */
    private function routes($method): array
    {
        return $this->routes[$method] ?? [];
    }

    /**
     * @param $method
     * @param $uri
     * @return DispatchedRoute|null
     */
    public function dispatch($method, $uri): ?DispatchedRoute
    {
        $routes = $this->routes(strtoupper($method));
        if (\array_key_exists($uri, $routes)) {
            return new DispatchedRoute($routes[$uri]);
        }
        return $this->doDispatch($method, $uri);
    }


    /**
     * @param $method
     * @param $uri
     */
    private function doDispatch($method, $uri): ?DispatchedRoute
    {
        foreach ($this->routes($method) as $route => $controller) {
            $pattern = '#^' . $route . '$#s';
            if (preg_match($pattern, $uri, $parameters)) {
                return new DispatchedRoute($controller, $parameters);
            }
        }
        return null;
    }

    /**
     * @param mixed $method
     * @param mixed $pattern
     * @param mixed $controller
     * @return void
     */
    public function register(mixed $method, mixed $pattern, mixed $controller): void
    {
        $convert = (string)$this->convertPatternt($pattern);
        $this->routes[strtoupper($method)][$convert] = $controller;
    }

    /**
     * @param string $pattern
     * @return array|string|null
     */
    private function convertPatternt(string $pattern): array|string|null
    {
        if (!str_contains($pattern, '(')) {
            return $pattern;
        }
        return preg_replace_callback('#\((\w+):(\w+)\)#', [$this, 'replacePattern'], $pattern);
    }

    /**
     * @param $matches
     * @return string
     */
    private function replacePattern($matches): string
    {
        return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
    }
}