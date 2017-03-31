<?php
/**
 * Module configuration
 *
 * This contains an example of an extra field of configuration that needs
 * to be included BUT it contains a PHP constant, so cannot be in a YAML file.
 *
 * These are most commonly paths and environment.
 */
return [
    'view_manager' => [
        'template_path_stack' => [
            OMEKA_PATH . '/modules/OmekaModuleStarterKit/view',
        ],
    ],
];