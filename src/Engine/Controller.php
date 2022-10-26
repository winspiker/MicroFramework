<?php
declare(strict_types=1);

namespace Winspiker\HidemyCMS\Engine;


use Winspiker\HidemyCMS\Engine\Core\View\View;
use Winspiker\HidemyCMS\Engine\DI\DI;


class Controller
{
    protected View $view;

    public function __construct(DI $di)
    {
        $this->view = $di->get('view');
    }
}