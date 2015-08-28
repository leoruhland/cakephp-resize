<?php
use Cake\Routing\Router;

Router::plugin('Resize', ['path' => '/'], function ($routes) {
    $routes->connect('/img/resize/:size/:filename', ['controller' => 'Resize', 'action' => 'resize'], ['pass' => ['size','filename']]);
    $routes->fallbacks('InflectedRoute');
});
