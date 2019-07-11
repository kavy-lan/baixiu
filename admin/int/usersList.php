<?php 
	/**
	 * 这个页面是用来查询数据的
	 */
	
	// 1. 引入外部文件
	include '../../functions.php';

	// 2. 调用方法查询数据
	//role为0的是超级管理员，不要渲染出来，防止被删除
	$res = select('select * from users where role=1 order by id');

	// print_r($res);
	// 3. 判断查询结果
	if(!$res){
		die('查询数据失败...');
	}

	// 4. 准备返回给前台的数据
	$arr = array(
		'code'=>'10000',
		'msg'=>'success',
		'data'=>$res
	);

	// 将信息返回给前台页面
	echo json_encode($arr);

	
 ?>