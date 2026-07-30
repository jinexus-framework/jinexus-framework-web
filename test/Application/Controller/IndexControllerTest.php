<?php

declare(strict_types=1);

namespace Application\Test\Controller;

use Application\Controller\IndexController;
use Application\Test\Fixture\ApplicationDouble;
use Application\Test\Fixture\ViewDouble;
use JiNexus\Config\Config\Config;
use JiNexus\Http\Http\Http;
use JiNexus\Http\Request\Request;
use JiNexus\ModuleManager\ModuleManager\ModuleManager;
use JiNexus\Route\Route\Factory\RouteFactory;
use JiNexus\Route\RouteException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(IndexController::class)]
final class IndexControllerTest extends TestCase
{
    private array $server;

    protected function setUp(): void
    {
        $this->server = $_SERVER;
    }

    protected function tearDown(): void
    {
        $_SERVER = $this->server;
    }

    private function createController(): IndexController
    {
        $config = new Config();
        $config->set('routes', [
            'application.home' => [
                'route' => '/',
                'controller' => IndexController::class,
                'action' => 'index',
            ],
        ]);
        $config->set('view_manager', [
            'template_path_stack' => '',
            'template_map' => [
                'layout/layout' => '',
                'error/404' => '',
            ],
        ]);

        $_SERVER['SERVER_NAME'] = 'example.com';
        $_SERVER['SERVER_PORT'] = '80';
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['PHP_SELF'] = '/index.php';

        $request = new Request();
        $http = new Http($request);
        $moduleManager = new ModuleManager();
        $route = RouteFactory::build();
        $route->redirect->setRoutes($config->get('routes'));

        $app = new ApplicationDouble($config, $http, $moduleManager, $route);
        $app->view = new ViewDouble($app);

        return new IndexController($app);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function index_action_view_model_has_a_title(): void
    {
        $controller = $this->createController();
        $result = $controller->indexAction();
        $variables = $result->getVariables();

        self::assertArrayHasKey('title', $variables);
        self::assertSame('JiNexus Framework', $variables['title']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function index_action_view_model_has_meta_description(): void
    {
        $controller = $this->createController();
        $result = $controller->indexAction();
        $variables = $result->getVariables();

        self::assertArrayHasKey('meta', $variables);
        self::assertArrayHasKey('description', $variables['meta']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function index_action_view_model_has_og_url(): void
    {
        $controller = $this->createController();
        $result = $controller->indexAction();
        $variables = $result->getVariables();

        self::assertArrayHasKey('og', $variables['meta']);
        self::assertArrayHasKey('url', $variables['meta']['og']);
    }
}
