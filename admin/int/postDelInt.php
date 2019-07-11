<?php  

    include '../../functions.php';
    $id=$_GET['id'];
    $res=del("delete  from posts where id=$id");
    if($res){
        $arr=array(
            "code"=>200,
            "msg"=>"删除成功",
        );
        echo json_encode($arr);
    }else{
        $arr=array(
            "code"=>201,
            "msg"=>"删除失败",
        );
        echo json_encode($arr);
    }
  


?>