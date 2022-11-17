<?php

declare(strict_types=1);

use Winspiker\MicroFramework\Engine\Core\HttpBasics\Request\Request;
use Winspiker\MicroFramework\Engine\DI\DI;
use Winspiker\MicroFramework\Engine\Runner\Runner;

require_once __DIR__ . "/../constants.php";
require_once ROOT_DIR . 'vendor/autoload.php';

try {
    $di = new DI();

    $services = require ROOT_DIR . 'src/Engine/Config/service.php';

    foreach ($services as $service) {
        $provider = new $service($di);
        $provider->init();
    }

    $runner = new Runner($di);
    
    $response = $runner->run(Request::createFromGlobals());
    $response->send();
} catch (Exception $e) {

}