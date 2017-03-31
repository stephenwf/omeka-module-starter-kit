<?php
/**
 * Services
 *
 * Services can be defined in factories and invokables just likes controllers. See
 * the comments there for different options for maintaining a DI container.
 *
 * Note: in this example we are requiring Guzzle only as an example of a very
 * common library pulled in.
 */

use GuzzleHttp\Client;
use Interop\Container\ContainerInterface;
use OmekaModuleStarterKit\Repository\MovieRepository;


return [
    'service_manager' => [
        'invokables' => [],
        'factories' => [
            'movies.guzzle' => function () {
                return new Client();
            },
            'movies.repo' => function (ContainerInterface $c) {
                $config = $c->get('Config'); // Module/app configuration.
                return new MovieRepository($config['movie_api_endpoint'], $c->get('movies.guzzle'));
            }
        ]
    ]
];