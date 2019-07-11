<?php 
$users=array(
    "username"=>"kahone",
    "password"=>123
);
$username=$_POST['username'];
$password=$_POST['password'];
if($username==$users['username']){

}else{
    $arr=array(
        "flag"=>201,
        "msg"=>"用户名错误"
    );
    echo json_encode($arr);
    exit;
}
if($password==$users['password']){
    $arr=array(
        "flag"=>1,
        "msg"=>"登录成功"
    );
    echo json_encode($arr);
    
}else{
    $arr=array(
        "flag"=>2,
        "msg"=>"密码错误"
    );
    echo json_encode($arr);
}


?>