<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Core\View;

use Winspiker\MicroFramework\Engine\Core\FileManager\FileManager;
use Winspiker\MicroFramework\Engine\DI\DI;
use Winspiker\MicroFramework\Engine\Core\Templater\Renderer;

class View
{
    private Renderer $renderer;
    private FileManager $fileManager;

    /**
     * @param DI $di
     */


    public function __construct(Renderer $renderer, FileManager $fileManager){
        $this->renderer = $renderer;
        $this->fileManager = $fileManager;
    }


    public function render(string $tamplateName, array $data = []): string
    {
        ob_start();
        extract($data, EXTR_SKIP);
        $content = $this->renderer->render($tamplateName);
        $filePath = $this->fileManager->saveResult($tamplateName, $content);
        require $filePath;
        return ob_get_clean();
    }
}
