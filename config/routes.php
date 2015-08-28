<?php
use Cake\Routing\Router;

Router::plugin('Resize', ['path' => '/'], function ($routes) {
    $routes->connect(
        '/resize/:size/**',
        [
            'controller' => 'Resize',
            'action' => 'resize'
        ],
        [
            'pass' => ['size', 'filename']
        ]);
    $routes->fallbacks('InflectedRoute');
});
