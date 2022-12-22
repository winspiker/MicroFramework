<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Services\Router;

use Winspiker\MicroFramework\Engine\Services\AbstractProvider;

use Winspiker\MicroFramework\Engine\Core\Router\Router;

final class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    private const ROUTER_SERVICE = 'router';

    public function init(): void
    {
        $router = new Router();

        $this->di->set(self::ROUTER_SERVICE, $router);
    }
}