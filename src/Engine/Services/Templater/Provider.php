<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Services\Templater;

use Winspiker\MicroFramework\Engine\Core\Templater\Parser;
use Winspiker\MicroFramework\Engine\Services\AbstractProvider;
use Winspiker\MicroFramework\Engine\Core\Templater\Renderer;

final class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    private const RENDERER_SERVICE = 'renderer';

    public function init(): void
    {
        $fileManager = $this->di->get('filemanager');
        $parser = new Parser($fileManager);
        $renderer = new Renderer(TEMPLATE_DIR, $fileManager, $parser);

        $this->di->set(self::RENDERER_SERVICE, $renderer);
    }
}