<?php
declare(strict_types=1);

namespace Winspiker\HidemyCMS\Engine\Services\View;

use Winspiker\HidemyCMS\Engine\Services\AbstractProvider;
use Winspiker\HidemyCMS\Engine\Core\View\View;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    private const VIEW_SERVICE = 'view';

    /**
     * @return mixed|void
     */
    public function init()
    {
        $renderer = $this->di->get('renderer');
        $fileManager = $this->di->get('filemanager');
        $view = new View($renderer, $fileManager);

        $this->di->set(self::VIEW_SERVICE, $view);
    }
}