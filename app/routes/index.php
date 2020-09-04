<?php
/** @var Router $route */

use app\lib\Router;

$route->get('/about', function() {
    echo 'router work<br>';
}) ;