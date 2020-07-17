<?php
$client = stream_socket_client("tcp://127.0.0.1:8889",$errno,$errstr);
if(!$client){
    exit("链接异常：{$errno}  {$errstr}");
}
$data['class'] = 'user';
$data['method'] = 'get_name';
$_data = json_encode($data);
fwrite($client,$_data);
$server_data = fread($client,2048);
$result1 = json_decode($server_data,true);
fclose($client);
var_dump($result1);