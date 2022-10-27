<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine;


use Winspiker\MicroFramework\Engine\Core\View\View;
use Winspiker\MicroFramework\Engine\DI\DI;


class Controller
{
    protected View $view;

    public function __construct(DI $di)
    {
        $this->view = $di->get('view');
    }
}