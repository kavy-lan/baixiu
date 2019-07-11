<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script src="./jquery-1.12.4.min.js"></script>
<body>
    <form id="userForm"> 
        用户名：<input type="text" name="username" id="username"> 
        密码：<input type="text" name="password" id="password"> 
        <input type="button" value="登录" id="btn" name="submit"> 
    </form>
</body>
<script>
    $('#btn').on('click',function(){
        var data=$('#userForm').serialize();
        // console.log(data)
       $.ajax({
           type:'post',
           url:'./check/check.php',
           data:data,
           dataType:'json',
           success:function(res){
              if(res&& res.flag==1){
                  location.href='./success/success.php';
              }else{
                location.href='./failure/failure.php';
              }
           }
           
       })
    })
</script>
</html>