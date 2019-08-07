<?php

/*
 *  Routes for WebSocket
 *
 * Add route (Symfony Routing Component)
 * $socket->route('/myclass', new MyClass, ['*']);
 */
$socket->route('/server', new \App\Http\Sockets\Server(), ['*']);
$socket->route('/chat', new \App\Http\Sockets\Chat(), ['*']);