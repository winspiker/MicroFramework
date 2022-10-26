<?php
declare(strict_types=1);

namespace Winspiker\HidemyCMS\Engine\Services\Router;

use Winspiker\HidemyCMS\Engine\Services\AbstractProvider;

use Winspiker\HidemyCMS\Engine\Core\Router\Router;

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