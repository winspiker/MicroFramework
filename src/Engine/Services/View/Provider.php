<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Services\View;

use Winspiker\MicroFramework\Engine\Services\AbstractProvider;
use Winspiker\MicroFramework\Engine\Core\View\View;

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