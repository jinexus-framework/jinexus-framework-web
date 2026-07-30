<?php

declare(strict_types=1);

namespace Application\Controller;

use JiNexus\Mvc\Controller\AbstractController;
use JiNexus\Mvc\Model\ViewModel;
use JiNexus\Route\RouteException;

/**
 * Class DocumentationController
 * @package Application\Controller
 */
class DocumentationController extends AbstractController
{
    /**
     * @throws RouteException
     */
    public function indexAction(): void
    {
        $this->redirect->toRoute('application.documentation.getting-started.introduction');
    }

    /**
     * @throws RouteException
     */
    public function gettingStartedAction(): void
    {
        $this->redirect->toRoute('application.documentation.getting-started.introduction');
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function gettingStartedIntroductionAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Documentation - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.documentation.getting-started.introduction'),
                    'description' => 'Go and get started to explore our docs',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-documentation-cover.png'),
                ],
            ],
            'mainSidebar' => [
                'active' => ['getting-started', 'introduction'],
            ]
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function gettingStartedInstallationAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Documentation - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.documentation.getting-started.installation'),
                    'description' => 'Go and get started to explore our docs',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-documentation-cover.png'),
                ],
            ],
            'mainSidebar' => [
                'active' => ['getting-started', 'installation']
            ]
        ]);
    }

    /**
     * @throws RouteException
     */
    public function walkthroughAction(): void
    {
        $this->redirect->toRoute('application.documentation.walkthrough.introduction');
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function walkthroughIntroductionAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Documentation - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.documentation.walkthrough.introduction'),
                    'description' => 'Go and get started to explore our docs',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-documentation-cover.png'),
                ],
            ],
            'mainSidebar' => [
                'active' => ['walkthrough', 'introduction'],
            ]
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function walkthroughModuleManagerAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Documentation - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.documentation.walkthrough.module-manager'),
                    'description' => 'Go and get started to explore our docs',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-documentation-cover.png'),
                ],
            ],
            'mainSidebar' => [
                'active' => ['walkthrough', 'module-manager'],
            ]
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function walkthroughControllerAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Documentation - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.documentation.walkthrough.controller'),
                    'description' => 'Go and get started to explore our docs',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-documentation-cover.png'),
                ],
            ],
            'mainSidebar' => [
                'active' => ['walkthrough', 'controller'],
            ]
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function walkthroughRouteAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Documentation - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.documentation.walkthrough.route'),
                    'description' => 'Go and get started to explore our docs',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-documentation-cover.png'),
                ],
            ],
            'mainSidebar' => [
                'active' => ['walkthrough', 'route'],
            ]
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function walkthroughHttpAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Documentation - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.documentation.walkthrough.http'),
                    'description' => 'Go and get started to explore our docs',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-documentation-cover.png'),
                ],
            ],
            'mainSidebar' => [
                'active' => ['walkthrough', 'http'],
            ]
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function walkthroughViewAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Documentation - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.documentation.walkthrough.view'),
                    'description' => 'Go and get started to explore our docs',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-documentation-cover.png'),
                ],
            ],
            'mainSidebar' => [
                'active' => ['walkthrough', 'view'],
            ]
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function walkthroughConfigAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Documentation - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.documentation.walkthrough.config'),
                    'description' => 'Go and get started to explore our docs',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-documentation-cover.png'),
                ],
            ],
            'mainSidebar' => [
                'active' => ['walkthrough', 'config'],
            ]
        ]);
    }
}
