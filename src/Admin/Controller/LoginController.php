<?php
declare(strict_types=1);

namespace Winspiker\HidemyCMS\Admin\Controller;


use Winspiker\HidemyCMS\Engine\Controller;

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