<?php 
    $conn=mysqli_connect('127.0.0.1','root','123456','itcast');
    if($conn){
        // echo '链接数据库成功';
    }else{
        echo '链接数据库失败';
        exit;
    }
    $query=mysqli_query($conn,'select * from test ');
    mysqli_close($conn);
    if(!$query){
        die("查询数据库失败");
    }else if(mysqli_num_rows($query)==0){
        die("数据库表为空");
    }else{
        while($row=mysqli_fetch_assoc($query)){
            $arr[]=$row;
        };
        print_r($arr);
    }

?>