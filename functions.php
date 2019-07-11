<?php 
	/**
	 * 在此文件下面封装了公共的函数
	 * 判断是否登陆的函数
	 * 连接
	 * 增
	 * 删
	 * 修改
	 * 查询
	 */
	// 先引入定义好的配置文件
	// include '../config.php';
	include __DIR__.'/config.php';

	// 定义了一个用来检测是否登陆的函数
	function checkLogin(){
		 session_start();// 先开启session
	  if(!isset($_SESSION['userInfo'])){
	    // 跳转到登陆页面
	    header('location:./login.php');
	  }
	}

	// 封装了一个连接数据库的函数
	function connect(){
		// 1.使用方法进行连接
		$conn = mysqli_connect(DB_HOST,DB_NAME,DB_PASS,DB_DATABASE);

		// 2. 判断连接是否成功
		if(!$conn){
			die('数据库连接失败...');
		}

		// 3. 设置数据库的编码方式
		mysqli_set_charset($conn,DB_SET_CHARSET);

		// 4. 将连接对象返回
		return $conn;
	}


	// 封装了一个添加数据的函数 
	function insert($table,$arr){

		// 做添加的时候，我们是将表单中具有name属性的值提交到服务器
		// email = 'aa@com' slug='aaa'
		// $sql = "insert into users (email,slug,nickname,password,status,avatar) values ('$email','$slug','$nickname','$password','$status','/uploads/avatar.jpg')";
		/**
		 * 为什么传递参数的时候，要传一个数据表和数据
		 * 1. 因为添加的时候,肯定是往不同的表中添加数据
		 * 2. 在页面中收集到的数据,提交给后台后，是存在$_POST这个关联数组当中
		 * 3. 因为添加数据的sql语句格式是固定的,变化仅仅是数据的变化而已
		 * 4. 现在只要在insert函数当中拼接成sql语句,外面只需要传参即可  方便后期的使用
		 */
		// 1. 调用方法获取连接对象
		$conn = connect(); // 

		// 2. 提取关联数组中的键和值
		$key = array_keys($arr); // 提取关联数组中的键
		$vals = array_values($arr);// 提取关联数组中的值

		// 3. 拼接sql语句 
		$sql = "insert into ".$table." (".implode(",",$key).") values ('".implode("', '",$vals)."')";
		// echo $sql;
		// exit;

		// 4. 添加数据
		$res = mysqli_query($conn,$sql);

		// 5. 关闭数据库的连接
		mysqli_close($conn);

		// 6. 返回添加的结果
		return $res;
	}

	// 封装一个删除的函数
	function del($sql){
		// 1. 连接数据库
		$conn = connect();

		// 2. 删除数据
	  $res =	mysqli_query($conn,$sql); 

	  // 3. 返回结果
	  return $res;
	}

	function delMore($table,$arr){
		// 1. 连接数据库
		$conn = connect();

		// 2. 准备sql语句 
		// $sql = "delete from users where id in (2,5,9)";
		$sql = "delete from ".$table." where id in (".implode(",",$arr).")";
		// echo $sql;
		// exit;

		// 3. 调用方法批量删除数据
		$res = mysqli_query($conn,$sql);

		mysqli_close($conn);
		// 4. 返回删除的结果
		return $res;
	}

	// 封装一个修改的函数
	function update($table,$arr,$id){
		// $sql = "update users set email = '$email', slug='$slug', nickname = '$nickname' where id = $id";
		// 1. 连接数据库
		$conn = connect();

		unset($arr['id']);// 删除数据中的id那一项,因为 id不需要更新
		// 2. 准备sql语句 
		$sql = "update ".$table." set ";

		$str = "";
		foreach($arr as $key=>$val){
			// $str .= $key."=".$val.", "; 
			$str .= $key."='".$val."', "; // 是将传递过来的数据中的数据拼接成 字段1='值1',字段2='值2'
		}
		$str = substr($str,0,-2);

		// 3. 拼接字符串
		$sql = $sql.$str." where id = $id";
		// echo $sql;  // update users setid=6, email=tom@itcast.com, slug=tom1231, nickname=tom123 where id = 6
		//update users set email='tom@itcast.com', slug='tom1231', nickname='tom123' where id = 6
		// exit;
		// 4. 调用方法进行更新
		$res = mysqli_query($conn,$sql);

		// 5. 将结果返回
		return $res;
	}

	// 封装一个查询的函数
	function select($sql){
		// 1. 先建立数据库的连接
		$conn = connect();

		// 2. 调用方法查询数据
		$res = mysqli_query($conn,$sql);
		
		
		mysqli_close($conn); // 关闭数据库
		// 3. 判断有没有查询到数据  
		// 有三种情况: 1.查询失败false  2. 查询成功但是没有数据 3. 有很多数据
		if(!$res){
			
			die('数据库查询失败...');
		}else if(mysqli_num_rows($res)==0){
			
			// die('数据表为空没有值...');
			return [];
		}else {
			while($row = mysqli_fetch_assoc($res)){
				$arr[] = $row;
			}
			
			return $arr;
		}
	}
 ?>