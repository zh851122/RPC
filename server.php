<?php
$server_sockert = stream_socket_server("tcp://127.0.0.1:8889",$errno,$errstr);

if(!$server_sockert){
    var_dump("服务异常",$errno,$errstr); exit;
}

//创建成功了，读取
while (1){
    $returnData = [];
    try{
        //字节流读取
        $buff = @stream_socket_accept($server_sockert);

        $data = fread($buff,2048);

        $_json_data = json_decode($data,true);
        $class = $_json_data['class'];
        $method = $_json_data['method'];
        $file = $class.".php";
        if(!file_exists($file)){
           throw new Exception('文件不存在','-1');
        }
        require_once $file;
        $user_obj = new $class();
        $server_data = $user_obj->$method();

        $returnData['code'] = 1;
        $returnData['data'] = $server_data;
        $returnData['msg'] = 'ok';
        $returnData = json_encode($returnData);
        fwrite($buff,$returnData);
        fclose($buff);

    }catch (Exception $e){
        $errData['code'] =$e->getCode();
        $errData['data'] = '';
        $errData['msg'] = $e->getMessage();
        $errData = json_encode($returnData);
        fwrite($buff,$returnData);
        fclose($buff);
    }

    var_dump($_json_data);
}
