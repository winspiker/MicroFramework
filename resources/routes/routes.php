<?php
declare(strict_types=1);

use Winspiker\MicroFramework\Main\Controller\HomeController;

$this->router->add('home', '/', [HomeController::class, "index"]);
$this->router->add('news', '/news', [HomeController::class, "news"]);
$this->router->add('contacts', '/contacts', [HomeController::class, "contacts"]);
$this->router->add('support', '/support', [HomeController::class, "support"]);