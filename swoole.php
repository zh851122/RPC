<?php
$server = new Swoole\Server("127.0.0.1",9088);
$server->set(array("workent_num"=>2));
$server->on("receive",function ($server,$fd,$from_id,$data){
    //$data 接收客户端发送的数据
    var_dump($data);
    //var_dump($server);
    var_dump($fd);
    var_dump($from_id);
   $result = '';
   $server->send($fd,json_encode(['data'=>$result]));
   //给客户端发数据

});
$server->start();