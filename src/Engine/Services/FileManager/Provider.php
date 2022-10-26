<?php
declare(strict_types=1);

namespace Winspiker\HidemyCMS\Engine\Services\FileManager;

use Winspiker\HidemyCMS\Engine\Services\AbstractProvider;

use Winspiker\HidemyCMS\Engine\Core\FileManager\FileManager;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    private const FILEMANAGER_SERVICE = 'filemanager';

    /**
     * @return mixed|void
     */
    public function init()
    {
        $fileManager = new FileManager();

        $this->di->set(self::FILEMANAGER_SERVICE, $fileManager);
    }
}