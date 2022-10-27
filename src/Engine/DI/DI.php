<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\DI;

final class DI
{
    /**
     * @var array
     */
    private array $container = [];

    /**
     * @param mixed $key
     * @param mixed $value
     * @return DI
     */
    public function set(mixed $key, mixed $value): DI
    {
        $this->container[$key] = $value;
        return $this;
    }


    /**
     * @param mixed $key
     * @return mixed
     */
    public function get(mixed $key): mixed
    {
        return $this->has($key);
    }


    /**
     * @param mixed $key
     * @return mixed
     */
    private function has(mixed $key): mixed
    {
        return $this->container[$key] ?? null;
    }
}