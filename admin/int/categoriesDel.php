<?php  
    include '../../functions.php';
    if($_SERVER['REQUEST_METHOD']=='GET'){
        // print_r($_GET);
        $id=$_GET['id'];
        
        $res=del("delete from categories where id=$id");
        if($res){
            $arr=array(
                "code"=>100,
                "msg"=>"删除成功"
            );
            echo json_encode($arr);
        }else{
            $arr=array(
                "code"=>101,
                "msg"=>"删除失败"
            );
            echo json_encode($arr);
        }


    }



?>