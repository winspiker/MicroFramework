<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Main\Controller;

use Winspiker\MicroFramework\Engine\Controller;

class HomeController extends Controller
{

    /**
     * Home page
     */
    public function index(): void
    {
        echo $this->view->render('home', ['name' => 'Alex']);
    }

    /**
     * News page
     */
    public function news(): void
    {
        echo $this->view->render('news', ['news' => 'Срочные новости!', 'text' => 'Житель Киева (Ромашка) сьел БОМЖА!']);
    }

    /**
     * Contacts page
     */
    public function contacts(): void
    {
        echo $this->view->render('contacts', ['name' => 'Alexaaa', 'phone' => '+380 (67) 627 5009']);
    }

    /**
     * Support page
     */
    public function support(): void
    {
        echo $this->view->render('support', ['call' => 'Telegram', 'link' => 'https://t.me/shittycoms']);
    }

}