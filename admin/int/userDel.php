<?php 
	/**
	 * 此文件要进行数据删除的操作
	 */
	
	// 1. 引入文件
	include '../../functions.php';
	if($_SERVER['REQUEST_METHOD']=='GET'){
			// 2.接收传递过来的参数
	$id = $_GET['id'];

	// 3. 调用方法删除数据
	$res = del("delete from users where id = $id");

	// 4. 判断是否删除成功
	if(!$res){
		die('删除数据失败...');
	}

	// 5. 返回数据
	$arr = array(
		'code'=>10000,
		'msg'=>'success'
	);

	echo json_encode($arr);
	}
if($_SERVER['REQUEST_METHOD']=='POST'){
			// $ids=$_POST['ids'];
			
			$res=delMore('users',$_POST['ids']);
			
			if($res){
				$arr=array(
					'code'=>10,
					'msg'=>'ok'

				);
				echo json_encode($arr);
			}else{
				$arr=array(
					'code'=>11,
					'msg'=>'ko'

				);
				echo json_encode($arr);
			}
			

		}

 ?>