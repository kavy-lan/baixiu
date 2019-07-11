<?php 
    include '../../functions.php';
   if($_SERVER['REQUEST_METHOD']=="GET"){
    $res=select("select * from options");
    if($res){
        $arr=array(
            "code"=>100,
            "mag"=>"读取成功",
            "data"=>$res
        );
        echo json_encode($arr);
    }else{
        $arr=array(
            "code"=>100,
            "mag"=>"读取失败",
           
        );
        echo json_encode($arr);
    }
   }
   if($_SERVER['REQUEST_METHOD']=="POST"){
       print_r($_FILES);
   }
?>