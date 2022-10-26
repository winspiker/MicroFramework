<?php
declare(strict_types=1);

namespace Winspiker\HidemyCMS\Engine\Services;

use Winspiker\HidemyCMS\Engine\DI\DI;

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