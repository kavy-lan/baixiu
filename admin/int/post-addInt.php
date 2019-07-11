<?php 

    include '../../functions.php';
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $res=select('select * from categories ');
        if($res){
            $arr=array(
                "code"=>100,
                "msg"=>'读取成功',
                "data"=>$res
            );
            echo json_encode($arr);
        }else{
             $arr=array(
                "code"=>101,
                "msg"=>'读取失败',
                
            );
            echo json_encode($arr);
        }

    }
     if($_SERVER['REQUEST_METHOD']=='POST'){
        if(!empty($_FILES)){
             $txt=strstr($_FILES['feature']['name'],'.');
        $imgName=uniqid().$txt;
        $imgPath='../../uploads/'.$imgName;
        // echo $imgPath;
        $res=move_uploaded_file($_FILES['feature']['tmp_name'],$imgPath);
        if($res){
            $arr=array(
                "code"=>200,
                "msg"=>'上传成功',
                "data"=>$imgPath
            );
           echo json_encode($arr);
        }else{
             $arr=array(
                "code"=>201,
                "msg"=>'上传失败',
               
            );
            echo json_encode($arr);
        }
        }

        if(!empty($_POST['title'])){
           
    // [feature] => ../../uploads/5b72dbe720785.jpg
    // [title] => 真的爱你
    // [content] => <p>qqq</p>
    // [slug] => ice222
    // [category_id] => 2
    // [created] => 2018-08-29T00:00
    // [status] => published
    session_start();
    $_POST['user_id']=$_SESSION['userInfo']['id'];
    // print_r($_POST);
    $res=insert('posts',$_POST);
    if($res){
            $arr=array(
                "code"=>300,
                "msg"=>'保存成功',
               
            );
           echo json_encode($arr);
          
        }else{
             $arr=array(
                "code"=>301,
                "msg"=>'保存失败',
               
            );
            echo json_encode($arr);
        }

        }
       
     }
     

 ?>