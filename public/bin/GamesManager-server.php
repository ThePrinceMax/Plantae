<?php
/**
 * Created by PhpStorm.
 * User: loicl
 * Date: 01/11/2018
 * Time: 16:00
 */
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use plantae\GamesManager;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new GamesManager()
        )
    ),
    8080
);

$server->run();