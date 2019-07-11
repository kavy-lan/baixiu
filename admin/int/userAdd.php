<?php 
	/**
	 * 此文件是用户添加的接口
	 */
	
	// print_r($_POST);

	// 1. 先引入 文件
	include '../../functions.php';

	$_POST['status'] = 'activated';
	$_POST['avatar'] = '/uploads/avatar.jpg';
	// 2. 调用方法添加数据
	$res = insert('users',$_POST);
	//insert into users (email,slug,nickname,password) values ('aaa@abc.com', 'aa', 'aaa', '123')
	// insert into users (email,slug,nickname,password,status,avatar) values ('aaa@abc.com', 'aa', 'aaa', '123', 'activated', '/uploads/avatar.jpg')

	// 判断是否添加成功
	if(!$res){
		die('数据添加失败...');
	}

	$arr = array(
		'code'=>10000,
		'msg'=>'success'
	);

	echo json_encode($arr);
 ?>