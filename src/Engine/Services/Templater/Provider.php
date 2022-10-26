<?php
declare(strict_types=1);

namespace Winspiker\HidemyCMS\Engine\Services\Templater;

use Winspiker\HidemyCMS\Engine\Core\Templater\Parser;
use Winspiker\HidemyCMS\Engine\Services\AbstractProvider;
use Winspiker\HidemyCMS\Engine\Core\Templater\Renderer;

class Provider extends AbstractProvider
{

    private const RENDERER_SERVICE = 'renderer';

    /**
     * @return mixed|void
     */
    public function init()
    {
        $fileManager = $this->di->get('filemanager');
        $parser = new Parser($fileManager);
        $renderer = new Renderer(TEMPLATE_DIR, $fileManager, $parser);

        $this->di->set(self::RENDERER_SERVICE, $renderer);
    }
}