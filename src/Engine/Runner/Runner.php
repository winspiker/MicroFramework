<?php
declare(strict_types=1);

namespace Winspiker\MicroFramework\Engine\Runner;


use Winspiker\MicroFramework\Engine\Core\FileManager\FileManager;
use Winspiker\MicroFramework\Engine\Core\HttpBasics\Request\Request;
use Winspiker\MicroFramework\Engine\Core\HttpBasics\Request\RequestStack;
use Winspiker\MicroFramework\Engine\Core\HttpBasics\Response\Response;
use Winspiker\MicroFramework\Engine\Core\Router\DispatchedRoute;
use Winspiker\MicroFramework\Engine\Core\Router\Router;
use Winspiker\MicroFramework\Engine\DI\DI;
use Winspiker\MicroFramework\Engine\Helper\Common;
use Winspiker\MicroFramework\Main\Controller\ErrorController;

class Runner
{
    /**
     * @var DI
     */
    private DI $di;
    private RequestStack $requestStack;
    private Router $router;
    private FileManager $fileManager;

    /**
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->requestStack = $di->get('request_stack');
        $this->router = $this->di->get('router');
        $this->fileManager = $this->di->get('filemanager');

    }

    private function routerFactory (string $routerFullDir) {
        $routes = $this->fileManager->getFiles($routerFullDir);
        foreach ($routes as $routesFile) {
            require_once $routesFile;
        }
    }

    private function executeController($routerDispatch): Response
    {

        [$controller, $action] = $routerDispatch->getController();
        $routerParams = $routerDispatch->getParameters();
        $parameters = \array_key_exists('id', $routerParams) ? array($routerParams['id']) : $routerParams;
        return \call_user_func_array([new $controller($this->di), $action], $parameters);

    }
    public function run(Request $request): Response
    {
        try {
            $this->requestStack->push($request);

            $this->routerFactory(RESOURCE_DIR . '/routes');
            
            $routerDispatch = $this->router->dispatch($request->getMethod(), $request->getPath());

        } catch (\Exception $e) {
            $routerDispatch = new DispatchedRoute([ErrorController::class, 'page404'], [$e->getMessage()]);

        } finally {
            $this->requestStack->pop($request);
            return $this->executeController($routerDispatch);
        }
    }
}