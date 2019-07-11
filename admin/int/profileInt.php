<?php 
    include '../../functions.php';
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $id=$_GET['id'];
        $res=select("select * from users where id= $id");
        if($res){
            $arr=array(
            "code"=>100,
            "msg"=>"读取成功",
            "data"=>$res
        );
       echo json_encode($arr);
        }else{
            $arr=array(
            "code"=>101,
            "msg"=>"读取失败",
           
        );
       echo json_encode($arr);
        }
    }
if($_SERVER['REQUEST_METHOD']=='POST'){
    
   if(!empty($_FILES)){
        $name=$_FILES['avatar']['name'];
    // echo $name;
 
    $nameLas=strstr($name,".");
    // $path=$_FILES['avatar']['tmp_name'];
    $newName=uniqid().$nameLas;
    $path='../../uploads/'.$newName;
    move_uploaded_file($_FILES['avatar']['tmp_name'],$path);
    $arr=array(
        'avatar'=>$path
    );
    session_start();
    $id=$_SESSION['userInfo']['id'];
  $res=update('users',$arr,$id);
  if($res){
    $result=array(
        "code"=>20,
        "msg"=>"更新成功",
        "data"=>$path
    );
    echo json_encode($result);
  }else{
       $result=array(
        "code"=>21,
        "msg"=>"更新成功",
       
    );
  }
   }

   if(isset($_POST['id'])){
     $res= update('users',$_POST,$_POST['id']);
     if($res){
         $arr=array(
            "code"=>20,
            "msg"=>"更新成功",
            "data"=>$res

         );
         echo json_encode($arr);
     }else{
          $arr=array(
            "code"=>20,
            "msg"=>"更新成功",
           

         );
     }
       
   }
  
}
?>