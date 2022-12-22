<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Services\FileManager;

use Winspiker\MicroFramework\Engine\Services\AbstractProvider;

use Winspiker\MicroFramework\Engine\Core\FileManager\FileManager;

final class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    private const FILEMANAGER_SERVICE = 'filemanager';

    public function init(): void
    {
        $fileManager = new FileManager();

        $this->di->set(self::FILEMANAGER_SERVICE, $fileManager);
    }
}