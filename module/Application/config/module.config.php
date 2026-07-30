<?php

declare(strict_types=1);

namespace Application;

use Application\Controller\AboutController;
use Application\Controller\ChangelogController;
use Application\Controller\IndexController;
use Application\Controller\DocumentationController;

return [
    'routes' => [
        'application.home' => [
            'route' => '/',
            'controller' => IndexController::class,
            'action' => 'index',
        ],
        'application.documentation' => [
            'route' => '/documentation',
            'controller' => DocumentationController::class,
            'action' => 'index',
        ],
        'application.documentation.getting-started' => [
            'route' => '/documentation/getting-started',
            'controller' => DocumentationController::class,
            'action' => 'gettingStarted',
        ],
        'application.documentation.getting-started.introduction' => [
            'route' => '/documentation/getting-started/introduction',
            'controller' => DocumentationController::class,
            'action' => 'gettingStartedIntroduction',
        ],
        'application.documentation.getting-started.installation' => [
            'route' => '/documentation/getting-started/installation',
            'controller' => DocumentationController::class,
            'action' => 'gettingStartedInstallation',
        ],
        'application.documentation.walkthrough' => [
            'route' => '/documentation/walkthrough',
            'controller' => DocumentationController::class,
            'action' => 'walkthrough',
        ],
        'application.documentation.walkthrough.introduction' => [
            'route' => '/documentation/walkthrough/introduction',
            'controller' => DocumentationController::class,
            'action' => 'walkthroughIntroduction',
        ],
        'application.documentation.walkthrough.module-manager' => [
            'route' => '/documentation/walkthrough/module-manager',
            'controller' => DocumentationController::class,
            'action' => 'walkthroughModuleManager',
        ],
        'application.documentation.walkthrough.controller' => [
            'route' => '/documentation/walkthrough/controller',
            'controller' => DocumentationController::class,
            'action' => 'walkthroughController',
        ],
        'application.documentation.walkthrough.route' => [
            'route' => '/documentation/walkthrough/route',
            'controller' => DocumentationController::class,
            'action' => 'walkthroughRoute',
        ],
        'application.documentation.walkthrough.http' => [
            'route' => '/documentation/walkthrough/http',
            'controller' => DocumentationController::class,
            'action' => 'walkthroughHttp',
        ],
        'application.documentation.walkthrough.view' => [
            'route' => '/documentation/walkthrough/view',
            'controller' => DocumentationController::class,
            'action' => 'walkthroughView',
        ],
        'application.documentation.walkthrough.config' => [
            'route' => '/documentation/walkthrough/config',
            'controller' => DocumentationController::class,
            'action' => 'walkthroughConfig',
        ],
        'application.changelog' => [
            'route' => '/changelog',
            'controller' => ChangelogController::class,
            'action' => 'index',
        ],
        'application.about' => [
            'route' => '/about',
            'controller' => AboutController::class,
            'action' => 'index',
        ],
        'application.about.author' => [
            'route' => '/about/author',
            'controller' => AboutController::class,
            'action' => 'author',
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
        'application.about.conduct' => [
            'route' => '/about/conduct',
            'controller' => AboutController::class,
            'action' => 'conduct',
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'layout/layout' => 'layout/layout.phtml',
            'error/404' => 'error/404.phtml',
        ],
        'template_path_stack' => __DIR__ . '/../view',
    ],
];
