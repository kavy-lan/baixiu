<?php 
    include '../../functions.php';
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $id=$_GET['id'];
        $res=select("select * from categories where id=$id");
        // print_r($res);
        if($res){
            $arr=array(
                "code"=>300,
                "msg"=>"读取成功",
                "data"=>$res
            );
            echo json_encode($arr);
        }else{
             $arr=array(
                "code"=>301,
                "msg"=>"读取失败"
               
            );
            echo json_encode($arr);
        }
    }
if($_SERVER['REQUEST_METHOD']=='POST'){
   $id=$_POST['id'];
   $res=update('categories',$_POST,$id);
  if($res){
     $arr=array(
                "code"=>400,
                "msg"=>"编辑成功",
               
            );
            echo json_encode($arr);
  }else{
    $arr=array(
                "code"=>401,
                "msg"=>"编辑失败",
                
            );
            echo json_encode($arr);
  }
}

 ?>