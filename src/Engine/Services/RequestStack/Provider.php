<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Services\RequestStack;

use Winspiker\MicroFramework\Engine\Services\AbstractProvider;

use Winspiker\MicroFramework\Engine\Core\HttpBasics\Request\RequestStack;

final class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    private const ROUTER_SERVICE = 'request_stack';

    public function init(): void
    {
        $router = new RequestStack();

        $this->di->set(self::ROUTER_SERVICE, $router);
    }
}