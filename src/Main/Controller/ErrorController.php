<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Main\Controller;


use Winspiker\MicroFramework\Engine\Controller;

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