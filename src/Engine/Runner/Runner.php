<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Runner;


use Winspiker\MicroFramework\Main\Controller\ErrorController;
use Winspiker\MicroFramework\Engine\Core\FileManager\FileManager;
use Winspiker\MicroFramework\Engine\Helper\Common;
use Winspiker\MicroFramework\Engine\Core\Router\DispatchedRoute;
use Winspiker\MicroFramework\Engine\Core\Router\Router;
use Winspiker\MicroFramework\Engine\DI\DI;

class Runner
{
    /**
     * @var DI
     */
    private DI $di;
    public Router $router;
    private FileManager $fileManager;

    /**
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
        $this->fileManager = $this->di->get('filemanager');
    }
    private function executeController($routerDispatch): void
    {

        [$controller, $action] = $routerDispatch->getController();
        $routerParams = $routerDispatch->getParameters();
        $parameters = \array_key_exists('id', $routerParams) ? array($routerParams['id']) : $routerParams;
        \call_user_func_array([new $controller($this->di), $action], $parameters);

    }
    public function run(): void
    {
        try {
            $routes = $this->fileManager->getFiles(RESOURCE_DIR . '/routes');
            foreach ($routes as $routesFile) {
                require_once $routesFile;
            }

            $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());

            $this->executeController($routerDispatch);
        } catch (\Exception $e) {
            $routerDispatch = new DispatchedRoute([ErrorController::class, 'page404'], [$e->getMessage()]);

            $this->executeController($routerDispatch);
        }
    }
}