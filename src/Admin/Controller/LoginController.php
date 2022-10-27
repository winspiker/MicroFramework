<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Admin\Controller;


use Winspiker\MicroFramework\Engine\Controller;

class LoginController extends Controller
{

    /**
     * Error page
     */
    public function login(): void
    {
        echo $this->view->render('login');
    }
}