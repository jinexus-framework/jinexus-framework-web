<?php

declare(strict_types=1);

namespace Application\Test\Controller;

use Application\Controller\AboutController;
use Application\Test\Fixture\ApplicationDouble;
use Application\Test\Fixture\RedirectDouble;
use Application\Test\Fixture\ViewDouble;
use JiNexus\Config\Config\Config;
use JiNexus\Http\Http\Http;
use JiNexus\Http\Request\Request;
use JiNexus\ModuleManager\ModuleManager\ModuleManager;
use JiNexus\Route\Route\Route;
use JiNexus\Route\RouteException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(AboutController::class)]
final class AboutControllerTest extends TestCase
{
    private array $server;

    private ApplicationDouble $app;

    protected function setUp(): void
    {
        $this->server = $_SERVER;
    }

    protected function tearDown(): void
    {
        $_SERVER = $this->server;
    }

    private function createController(): AboutController
    {
        $_SERVER['SERVER_NAME'] = 'example.com';
        $_SERVER['SERVER_PORT'] = '80';
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['PHP_SELF'] = '/index.php';

        $routes = [
            'application.about.author' => [
                'route' => '/about/author',
                'controller' => AboutController::class,
                'action' => 'author',
            ],
            'application.about.conduct' => [
                'route' => '/about/conduct',
                'controller' => AboutController::class,
                'action' => 'conduct',
            ],
            'application.about.credits' => [
                'route' => '/about/credits',
                'controller' => AboutController::class,
                'action' => 'credits',
            ],
            'application.about.license' => [
                'route' => '/about/license',
                'controller' => AboutController::class,
                'action' => 'license',
            ],
        ];

        $config = new Config();
        $config->set('routes', $routes);
        $config->set('view_manager', [
            'template_path_stack' => '',
            'template_map' => [
                'layout/layout' => '',
                'error/404' => '',
            ],
        ]);

        $request = new Request();
        $http = new Http($request);
        $moduleManager = new ModuleManager();
        $redirect = new RedirectDouble();
        $redirect->setRoutes($routes);
        $route = new Route($redirect);

        $this->app = new ApplicationDouble($config, $http, $moduleManager, $route);
        $this->app->view = new ViewDouble($this->app);

        return new AboutController($this->app);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function index_action_redirects_to_author(): void
    {
        $controller = $this->createController();
        $controller->indexAction();

        /** @var RedirectDouble $redirect */
        $redirect = $this->app->route->redirect;
        self::assertCount(1, $redirect->sentHeaders);
        self::assertStringContainsString('/about/author', $redirect->sentHeaders[0]['header']);
        self::assertSame(301, $redirect->sentHeaders[0]['statusCode']);
        self::assertSame(1, $redirect->terminateCount);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function author_action_view_model_has_title(): void
    {
        $controller = $this->createController();
        $variables = $controller->authorAction()->getVariables();

        self::assertArrayHasKey('title', $variables);
        self::assertSame('Author - JiNexus Framework', $variables['title']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function author_action_view_model_has_meta(): void
    {
        $controller = $this->createController();
        $variables = $controller->authorAction()->getVariables();

        self::assertArrayHasKey('meta', $variables);
        self::assertArrayHasKey('description', $variables['meta']);
        self::assertArrayHasKey('og', $variables['meta']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function author_action_view_model_has_og_url(): void
    {
        $controller = $this->createController();
        $variables = $controller->authorAction()->getVariables();

        self::assertStringContainsString('/about/author', $variables['meta']['og']['url']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function conduct_action_view_model_has_title(): void
    {
        $controller = $this->createController();
        $variables = $controller->conductAction()->getVariables();

        self::assertArrayHasKey('title', $variables);
        self::assertStringContainsString('Code of Conduct', $variables['title']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function conduct_action_view_model_has_meta(): void
    {
        $controller = $this->createController();
        $variables = $controller->conductAction()->getVariables();

        self::assertArrayHasKey('meta', $variables);
        self::assertArrayHasKey('description', $variables['meta']);
        self::assertArrayHasKey('og', $variables['meta']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function conduct_action_view_model_has_og_url(): void
    {
        $controller = $this->createController();
        $variables = $controller->conductAction()->getVariables();

        self::assertStringContainsString('/about/conduct', $variables['meta']['og']['url']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function credits_action_view_model_has_title(): void
    {
        $controller = $this->createController();
        $variables = $controller->creditsAction()->getVariables();

        self::assertArrayHasKey('title', $variables);
        self::assertSame('Credits - JiNexus Framework', $variables['title']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function credits_action_view_model_has_meta(): void
    {
        $controller = $this->createController();
        $variables = $controller->creditsAction()->getVariables();

        self::assertArrayHasKey('meta', $variables);
        self::assertArrayHasKey('description', $variables['meta']);
        self::assertArrayHasKey('og', $variables['meta']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function credits_action_view_model_has_og_url(): void
    {
        $controller = $this->createController();
        $variables = $controller->creditsAction()->getVariables();

        self::assertStringContainsString('/about/credits', $variables['meta']['og']['url']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function license_action_view_model_has_title(): void
    {
        $controller = $this->createController();
        $variables = $controller->licenseAction()->getVariables();

        self::assertArrayHasKey('title', $variables);
        self::assertSame('License - JiNexus Framework', $variables['title']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function license_action_view_model_has_meta(): void
    {
        $controller = $this->createController();
        $variables = $controller->licenseAction()->getVariables();

        self::assertArrayHasKey('meta', $variables);
        self::assertArrayHasKey('description', $variables['meta']);
        self::assertArrayHasKey('og', $variables['meta']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function license_action_view_model_has_og_url(): void
    {
        $controller = $this->createController();
        $variables = $controller->licenseAction()->getVariables();

        self::assertStringContainsString('/about/license', $variables['meta']['og']['url']);
    }
}
