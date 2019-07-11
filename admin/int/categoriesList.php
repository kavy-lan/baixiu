<?php 
    include '../../functions.php';
    if($_SERVER['REQUEST_METHOD']=='GET'){
       $res= select('select * from categories');
       if($res){
        $arr=array(
            "code"=>20,
            "msg"=>"读取成功",
            "data"=>$res
        );
        echo json_encode($arr);
       }else{
             $arr=array(
            "code"=>21,
            "msg"=>"读取失败",
            
        );
        echo json_encode($arr);
       }
    }
if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $res=insert('categories',$_POST);
    if($res){
        $arr=array(
            "code"=>200,
            "msg"=>"添加成功",
           
        );
        echo json_encode($arr);
    }else{
        $arr=array(
            "code"=>201,
            "msg"=>"添加失败",
           
        );
        echo json_encode($arr);
    }
}


 ?>