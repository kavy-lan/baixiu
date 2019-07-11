<?php 

	$arr = array(
		"email"=>"jack@itcast.com",
		"slug"=>"xiaocong",
		"nickname"=>"浪子大叔",
		"avatar"=>"/uploads/aa.jpg"
	);

	$key = array_keys($arr); // 
	$val = array_values($arr); // 

	// print_r($key);
	// echo '<hr/>';
	// print_r($val);

	$strKey = implode(",",$key);
	$strVal = implode("', '",$val);

	echo $strKey; // email,slug,nickname,avatar
	echo '<hr/>';  
	echo $strVal; // jack@itcast.com,xiaocong,浪子大叔,/uploads/aa.jpg
	// jack@itcast.com', 'xiaocong', '浪子大叔', '/uploads/aa.jpg


	// Array
	// (
	//     [0] => email
	//     [1] => slug
	//     [2] => nickname
	//     [3] => avatar
	// )
	// Array
	// (
	//     [0] => jack@itcast.com
	//     [1] => xiaocong
	//     [2] => 浪子大叔
	//     [3] => /uploads/aa.jpg
	// )

 ?>