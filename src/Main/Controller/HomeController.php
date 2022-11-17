<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Main\Controller;

use Winspiker\MicroFramework\Engine\Controller\Controller;
use Winspiker\MicroFramework\Engine\Core\HttpBasics\Response\Response;

class HomeController extends Controller
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
        $content = $this->view->render('news', ['news' => 'Срочные новости!', 'text' => 'Житель Киева (Ромашка) сьел БОМЖА!']);
        return new Response($content);
    }

    /**
     * Contacts page
     */
    public function contacts(): Response
    {
        $content = $this->view->render('contacts', ['name' => 'Alexaaa', 'phone' => '+380 (67) 627 5009']);
        return new Response($content);
    }

    /**
     * Support page
     */
    public function support(): Response
    {
        $content = $this->view->render('support', ['call' => 'Telegram', 'link' => 'https://t.me/shittycoms']);
        return new Response($content);
    }

}