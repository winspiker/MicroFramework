<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Core\HttpBasics\Request;

final class RequestStack
{
    /**
     * @var Request[]
     */
    private array $requests = [];

    /**
     * Pushes a Request on the stack.
     *
     * This method should generally not be called directly as the stack
     * management should be taken care of by the application itself.
     */
    public function push(Request $request): void
    {
        $this->requests[] = $request;
    }

    public function pop(Request $request): ?Request
    {
        if (!$this->requests) {
            return null;
        }

        return array_pop($this->requests);
    }

    public function getCurrentRequest(): ?Request
    {
        return end($this->requests) ?: null;
    }

}