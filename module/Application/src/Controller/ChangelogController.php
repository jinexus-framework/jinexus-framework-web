<?php

declare(strict_types=1);

namespace Application\Controller;

use JiNexus\Mvc\Controller\AbstractController;
use JiNexus\Mvc\Model\ViewModel;
use JiNexus\Route\RouteException;

/**
 * Class ChangelogController
 * @package Application\Controller
 */
class ChangelogController extends AbstractController
{
    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function indexAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Changelog - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.changelog'),
                    'description' => 'JiNexus Framework changelog',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-changelog-cover.png'),
                ],
            ],
        ]);
    }
}
