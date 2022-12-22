<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\DI;

final class DI
{
    private array $container = [];

    public function set(mixed $key, mixed $value): DI
    {
        $this->container[$key] = $value;
        return $this;
    }

    public function get(mixed $key): ?object
    {
        return $this->has($key);
    }

    private function has(mixed $key): ?object
    {
        return $this->container[$key] ?? null;
    }
}