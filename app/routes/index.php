<?php

use app\lib\Request;
use app\lib\Router;
use app\lib\SessionManager;
use app\lib\Messenger;

$session = new SessionManager();
$session->start();
$messenger = new Messenger($session);
$request = new Request();
$router = new router($request, $session, $messenger);

$router->get('/', 'Users@index');
$router->get('/login', 'Users@login');
$router->get('/logout', 'Users@logout');
$router->any('/register', 'Users@register');
$router->get('/profile', 'Users@profile');


// return not found page if the router not exit
if (!$router->dispatch()) {
    http_response_code(404);
    require VIEWS_PATH . DS . 'notfound' . DS . 'notfound.view.php';
}

