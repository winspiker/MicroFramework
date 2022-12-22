<?php /** @noinspection PhpInconsistentReturnPointsInspection */
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Core\Router;

use mysql_xdevapi\Exception;
use Winspiker\MicroFramework\Engine\Core\Router\DispatchedRoute;

final class UrlDispatcher
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

    public function addPattern(string $key, string $pattern): void
    {
        $this->patterns[$key] = $pattern;
    }

    private function routes(string $method): array
    {
        return $this->routes[$method] ?? [];
    }

    public function dispatch(string $method, string $uri): ?DispatchedRoute
    {
        $routes = $this->routes(strtoupper($method));
        if (\array_key_exists($uri, $routes)) {
            return new DispatchedRoute($routes[$uri]);
        }
        return $this->doDispatch($method, $uri);
    }

    private function doDispatch(string $method, string $uri): ?DispatchedRoute
    {
        foreach ($this->routes(strtoupper($method)) as $route => $controller) {
            $pattern = '#^' . $route . '$#s';
            if (preg_match($pattern, $uri, $parameters)) {
                return new DispatchedRoute($controller, $parameters);
            }
        }
        throw new \InvalidArgumentException(
            sprintf("Page not found %s", $uri)
        );
    }

    public function register(string $method, string $pattern, array $controller): void
    {
        $convert = (string)$this->convertPatternt($pattern);
        $this->routes[strtoupper($method)][$convert] = $controller;
    }


    private function convertPatternt(string $pattern): array|string|null
    {
        if (!str_contains($pattern, '(')) {
            return $pattern;
        }
        return preg_replace_callback('#\((\w+):(\w+)\)#', [$this, 'replacePattern'], $pattern);
    }

    private function replacePattern(array $matches): string
    {
        return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
    }
}