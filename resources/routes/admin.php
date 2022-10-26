<?php
declare(strict_types=1);

use Winspiker\HidemyCMS\Admin\Controller\LoginController;

$this->router->add('login', '/admin/login', [LoginController::class, "login"]);
