<?php
use realTime\Notify;
use Ratchet\Server\IoServer;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(new Notify(), 9051);
$server->run();
