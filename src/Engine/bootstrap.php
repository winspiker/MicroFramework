<?php

declare(strict_types=1);

use Winspiker\HidemyCMS\Engine\DI\DI;
use Winspiker\HidemyCMS\Engine\Runner\Runner;

require_once __DIR__ . '/../constants.php';
require_once ROOT_DIR . 'vendor/autoload.php';

try {
    $di = new DI();

    $services = require ROOT_DIR . 'src/Engine/Config/service.php';

    foreach ($services as $service) {
        $provider = new $service($di);
        $provider->init();
    }

    $worker = new Runner($di);

    $worker->run();

} catch (Exception $e) {

}