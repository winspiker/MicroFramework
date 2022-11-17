<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Admin\Controller;


use Winspiker\MicroFramework\Engine\Controller\Controller;

class ErrorController extends Controller
{

    /**
     * Error page
     */
    public function page404(): void
    {
        echo $this->view->render('error');
    }
}