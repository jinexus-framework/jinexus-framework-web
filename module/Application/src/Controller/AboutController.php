<?php

declare(strict_types=1);

namespace Application\Controller;

use JiNexus\Mvc\Controller\AbstractController;
use JiNexus\Mvc\Model\ViewModel;
use JiNexus\Route\RouteException;

/**
 * Class AboutController
 * @package Application\Controller
 */
class AboutController extends AbstractController
{
    /**
     * @throws RouteException
     */
    public function indexAction(): void
    {
        $this->redirect->toRoute('application.about.author', true);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function authorAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Author - JiNexus Framework',
            'meta' => [
                'description' => 'The fact that I don\'t believe that I\'m better than anyone else gives me an inevitable sense of superiority',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.about.author'),
                    'description' => 'DevOps (Development and Operations) with a focus on PHP web applications and cloud-based Ubuntu servers',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-author-cover.png'),
                ],
            ],
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function conductAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Contributor Code of Conduct - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.about.conduct'),
                    'description' => 'The JiNexus Framework project adheres to The Code Manifesto as its guidelines for contributor interactions',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-conduct-cover.png'),
                ],
            ],
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function creditsAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'Credits - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.about.credits'),
                    'description' => 'A short list were JiNexus Framework are inspired by',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-credits-cover.png'),
                ],
            ],
        ]);
    }

    /**
     * @return ViewModel
     * @throws RouteException
     */
    public function licenseAction(): ViewModel
    {
        $request = $this->request;

        return new ViewModel([
            'title' => 'License - JiNexus Framework',
            'meta' => [
                'description' => 'A modular, lightweight and easy to use PHP framework and probably the smallest and fastest MVC framework',
                'og' => [
                    'url' => $request->baseUrl() . $this->view->url('application.about.license'),
                    'description' => 'BSD 3-Clause License',
                    'image' => $request->baseUrl() . $this->view->basePath('asset/img/cover-photo/jinexus-framework-license-cover.png'),
                ],
            ],
        ]);
    }
}
