<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Core\Router;


class DispatchedRoute
{

    public function __construct(private array $controller, private array $parameters = [])
    {
        // Проверить если ли такой класс
        $controller = $this->controller[0];
        if(!class_exists($controller)) {
            throw new \InvalidArgumentException(
                sprintf('Class "%s" doesnt exist.', $controller)
            );
        }

        $method = (string)($this->controller[1]?? '__invoke');
        if (!method_exists($controller, $method)) {
            throw new \InvalidArgumentException(
                sprintf('Method "%s::%s" doesnt exist.', $controller, $method)
            );
        }

        $this->controller[1] = $method;

    }

    public function getController(): array
    {
        return $this->controller;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}


