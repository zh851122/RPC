<?php
$cli = new swoole_client(SWOOLE_SOCK_TCP);
$cli->connect('127.0.0.1',9088,60);
$data = json_encode(['a'=>1]);
$cli->send($data);
$result = $cli->recv(); //接收消息
$cli->close();
var_dump($result);
