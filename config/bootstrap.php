<?php

use Cake\Core\Configure;

Configure::write('Resize', [
    'defaultSize' => [50, 50], //for invalid sizes
    'sizes' => [], //whitelist of sizes[[100,100], [200,200]],
    'maxSize' => [1920, 1920], //you can define a maxSize
]);
