<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Services;

use Winspiker\MicroFramework\Engine\DI\DI;

abstract class AbstractProvider
{

    protected DI $di;

    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    abstract public function init(): void;

}