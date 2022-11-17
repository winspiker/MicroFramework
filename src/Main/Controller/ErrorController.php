<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Main\Controller;


use Winspiker\MicroFramework\Engine\Controller\Controller;
use Winspiker\MicroFramework\Engine\Core\HttpBasics\Response\Response;

class ErrorController extends Controller
{

    /**
     * Error page
     */
    public function page404($exception): Response
    {
        $content = $this->view->render('error', ['exception' => $exception]);
        return new Response($content);
    }
}