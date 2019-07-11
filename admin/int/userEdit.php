<?php 

	include '../../functions.php';
	if($_SERVER['REQUEST_METHOD']=='GET'){
		$id=$_GET['id'];
		$res=select("select * from users where id='$id'");
		$arr=array(
			'code'=>10,
			'msg'=>'success',
			'data'=>$res
		);
		echo json_encode($arr);

	}
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//將傳過來的id存起來
		$id=$_POST['id'];
		//因為不需要更新數據裡面的id，所以把id項去除掉
		unset($_POST['id']);
		//调用更新数据库的函数
		 $res=update('users',$_POST,$id);
		 if($res){
			 $arr=array(
				 'code'=>10,
				 'msg'=>'ok',

			 );
			 echo json_encode($arr);
		 }else{
			  $arr=array(
				 'code'=>11,
				 'msg'=>'ko',

			 );
			 echo json_encode($arr);
		 }
	
		
		
	}

 ?>