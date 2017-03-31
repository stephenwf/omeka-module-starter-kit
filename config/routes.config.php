<?php
/**
 * Routes
 *
 * Routes can be defined in the normal Zend way. They can also be
 * abstracted into commonly used fragments. This can help avoid bugs
 * and improve readability and provide as much IDE support as you need.
 */

use OmekaModuleStarterKit\Controller\MovieController;

function literalRoute(string $route, string $controller, string $action = 'index')
{
    return [
        'type' => 'Literal',
        'options' => [
            'route' => $route,
            'defaults' => [
                '__NAMESPACE__' => '',
                'controller' => $controller,
                'action' => $action,
            ],
        ],
    ];
}


return [
    'router' => [
        'routes' => [
            'starter_kit_test' => literalRoute('/starter-kit/movies', MovieController::class),
        ],
    ],
];