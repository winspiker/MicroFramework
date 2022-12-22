<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Main\Controller;

use Winspiker\MicroFramework\Engine\Controller\Controller;
use Winspiker\MicroFramework\Engine\Core\HttpBasics\Response\Response;

final class HomeController extends Controller
{

    /**
     * Home page
     */
    public function index(): Response
    {
        $content = $this->view->render('home', ['name' => 'Alex']);
        return new Response($content);
    }

    /**
     * News page
     */
    public function news(): Response
    {
        $content = $this->view->render('news', ['news' => 'Срочные новости!', 'text' => 'Что-то случилось(']);
        return new Response($content);
    }

    /**
     * Contacts page
     */
    public function contacts(): Response
    {
        $content = $this->view->render('contacts', ['name' => 'GitHub', 'phone' => 'https://github.com/winspiker']);
        return new Response($content);
    }

    /**
     * Support page
     */
    public function support(): Response
    {
        $content = $this->view->render('support', ['call' => 'Telegram', 'link' => 'https://t.me/winspiker']);
        return new Response($content);
    }

}