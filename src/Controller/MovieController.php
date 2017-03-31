<?php

namespace OmekaModuleStarterKit\Controller;

use OmekaModuleStarterKit\Repository\MovieRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MovieController extends AbstractActionController
{
    private $movies;

    public function __construct(MovieRepository $movies)
    {
        $this->movies = $movies;
    }

    public function indexAction()
    {

        $movies = $this->movies->searchMovies('Star Wars');

        return new ViewModel([
            'movies' => $movies
        ]);
    }
}