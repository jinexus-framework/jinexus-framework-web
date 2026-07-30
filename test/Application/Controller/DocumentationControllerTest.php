<?php

declare(strict_types=1);

namespace Application\Test\Controller;

use Application\Controller\DocumentationController;
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

#[CoversClass(DocumentationController::class)]
final class DocumentationControllerTest extends TestCase
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

    private function createController(): DocumentationController
    {
        $_SERVER['SERVER_NAME'] = 'example.com';
        $_SERVER['SERVER_PORT'] = '80';
        $_SERVER['REQUEST_URI'] = '/documentation';
        $_SERVER['PHP_SELF'] = '/index.php';

        $routes = [
            'application.documentation.getting-started.introduction' => [
                'route' => '/documentation/getting-started/introduction',
                'action' => 'gettingStartedIntroduction',
            ],
            'application.documentation.getting-started.installation' => [
                'route' => '/documentation/getting-started/installation',
                'action' => 'gettingStartedInstallation',
            ],
            'application.documentation.walkthrough.introduction' => [
                'route' => '/documentation/walkthrough/introduction',
                'action' => 'walkthroughIntroduction',
            ],
            'application.documentation.walkthrough.module-manager' => [
                'route' => '/documentation/walkthrough/module-manager',
                'action' => 'walkthroughModuleManager',
            ],
            'application.documentation.walkthrough.controller' => [
                'route' => '/documentation/walkthrough/controller',
                'action' => 'walkthroughController',
            ],
            'application.documentation.walkthrough.route' => [
                'route' => '/documentation/walkthrough/route',
                'action' => 'walkthroughRoute',
            ],
            'application.documentation.walkthrough.http' => [
                'route' => '/documentation/walkthrough/http',
                'action' => 'walkthroughHttp',
            ],
            'application.documentation.walkthrough.view' => [
                'route' => '/documentation/walkthrough/view',
                'action' => 'walkthroughView',
            ],
            'application.documentation.walkthrough.config' => [
                'route' => '/documentation/walkthrough/config',
                'action' => 'walkthroughConfig',
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

        return new DocumentationController($this->app);
    }

    // ---- redirect actions ----

    /**
     * @throws RouteException
     */
    #[Test]
    public function index_action_redirects_to_getting_started_introduction(): void
    {
        $controller = $this->createController();
        $controller->indexAction();

        /** @var RedirectDouble $redirect */
        $redirect = $this->app->route->redirect;
        self::assertCount(1, $redirect->sentHeaders);
        self::assertStringContainsString('/documentation/getting-started/introduction', $redirect->sentHeaders[0]['header']);
        self::assertSame(302, $redirect->sentHeaders[0]['statusCode']);
        self::assertSame(1, $redirect->terminateCount);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function getting_started_action_redirects_to_introduction(): void
    {
        $controller = $this->createController();
        $controller->gettingStartedAction();

        /** @var RedirectDouble $redirect */
        $redirect = $this->app->route->redirect;
        self::assertCount(1, $redirect->sentHeaders);
        self::assertStringContainsString('/documentation/getting-started/introduction', $redirect->sentHeaders[0]['header']);
        self::assertSame(302, $redirect->sentHeaders[0]['statusCode']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function walkthrough_action_redirects_to_introduction(): void
    {
        $controller = $this->createController();
        $controller->walkthroughAction();

        /** @var RedirectDouble $redirect */
        $redirect = $this->app->route->redirect;
        self::assertCount(1, $redirect->sentHeaders);
        self::assertStringContainsString('/documentation/walkthrough/introduction', $redirect->sentHeaders[0]['header']);
        self::assertSame(302, $redirect->sentHeaders[0]['statusCode']);
    }

    // ---- getting started ----

    /**
     * @throws RouteException
     */
    #[Test]
    public function getting_started_introduction_action_view_model_has_title(): void
    {
        $controller = $this->createController();
        $variables = $controller->gettingStartedIntroductionAction()->getVariables();

        self::assertArrayHasKey('title', $variables);
        self::assertSame('Documentation - JiNexus Framework', $variables['title']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function getting_started_introduction_action_view_model_has_meta(): void
    {
        $controller = $this->createController();
        $variables = $controller->gettingStartedIntroductionAction()->getVariables();

        self::assertArrayHasKey('meta', $variables);
        self::assertArrayHasKey('og', $variables['meta']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function getting_started_introduction_action_view_model_has_main_sidebar(): void
    {
        $controller = $this->createController();
        $variables = $controller->gettingStartedIntroductionAction()->getVariables();

        self::assertArrayHasKey('mainSidebar', $variables);
        self::assertSame(['getting-started', 'introduction'], $variables['mainSidebar']['active']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function getting_started_installation_action_view_model_has_title(): void
    {
        $controller = $this->createController();
        $variables = $controller->gettingStartedInstallationAction()->getVariables();

        self::assertArrayHasKey('title', $variables);
        self::assertSame('Documentation - JiNexus Framework', $variables['title']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function getting_started_installation_action_view_model_has_main_sidebar(): void
    {
        $controller = $this->createController();
        $variables = $controller->gettingStartedInstallationAction()->getVariables();

        self::assertArrayHasKey('mainSidebar', $variables);
        self::assertSame(['getting-started', 'installation'], $variables['mainSidebar']['active']);
    }

    // ---- walkthrough ----

    /**
     * @throws RouteException
     */
    #[Test]
    public function walkthrough_introduction_action_view_model_has_main_sidebar(): void
    {
        $controller = $this->createController();
        $variables = $controller->walkthroughIntroductionAction()->getVariables();

        self::assertArrayHasKey('mainSidebar', $variables);
        self::assertSame(['walkthrough', 'introduction'], $variables['mainSidebar']['active']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function walkthrough_module_manager_action_view_model_has_main_sidebar(): void
    {
        $controller = $this->createController();
        $variables = $controller->walkthroughModuleManagerAction()->getVariables();

        self::assertArrayHasKey('mainSidebar', $variables);
        self::assertSame(['walkthrough', 'module-manager'], $variables['mainSidebar']['active']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function walkthrough_controller_action_view_model_has_main_sidebar(): void
    {
        $controller = $this->createController();
        $variables = $controller->walkthroughControllerAction()->getVariables();

        self::assertArrayHasKey('mainSidebar', $variables);
        self::assertSame(['walkthrough', 'controller'], $variables['mainSidebar']['active']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function walkthrough_route_action_view_model_has_main_sidebar(): void
    {
        $controller = $this->createController();
        $variables = $controller->walkthroughRouteAction()->getVariables();

        self::assertArrayHasKey('mainSidebar', $variables);
        self::assertSame(['walkthrough', 'route'], $variables['mainSidebar']['active']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function walkthrough_http_action_view_model_has_main_sidebar(): void
    {
        $controller = $this->createController();
        $variables = $controller->walkthroughHttpAction()->getVariables();

        self::assertArrayHasKey('mainSidebar', $variables);
        self::assertSame(['walkthrough', 'http'], $variables['mainSidebar']['active']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function walkthrough_view_action_view_model_has_main_sidebar(): void
    {
        $controller = $this->createController();
        $variables = $controller->walkthroughViewAction()->getVariables();

        self::assertArrayHasKey('mainSidebar', $variables);
        self::assertSame(['walkthrough', 'view'], $variables['mainSidebar']['active']);
    }

    /**
     * @throws RouteException
     */
    #[Test]
    public function walkthrough_config_action_view_model_has_main_sidebar(): void
    {
        $controller = $this->createController();
        $variables = $controller->walkthroughConfigAction()->getVariables();

        self::assertArrayHasKey('mainSidebar', $variables);
        self::assertSame(['walkthrough', 'config'], $variables['mainSidebar']['active']);
    }
}
