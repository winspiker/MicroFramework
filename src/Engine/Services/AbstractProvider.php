<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Services;

use Winspiker\MicroFramework\Engine\DI\DI;

abstract class AbstractProvider
{
    /**
     * @var DI;
     */
    protected $di;

    /**
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    /**
     * @return mixed
     */
    abstract public function init();

}