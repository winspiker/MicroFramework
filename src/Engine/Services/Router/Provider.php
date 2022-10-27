<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Services\Router;

use Winspiker\MicroFramework\Engine\Services\AbstractProvider;

use Winspiker\MicroFramework\Engine\Core\Router\Router;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    private const ROUTER_SERVICE = 'router';

    /**
     * @return mixed|void
     */
    public function init()
    {
        $router = new Router();

        $this->di->set(self::ROUTER_SERVICE, $router);
    }
}